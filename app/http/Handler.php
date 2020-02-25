<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 27.10.18
 * Time: 1:35
 */

namespace App\Http;


use FastRoute\Dispatcher\GroupCountBased;
use Psr\Container\ContainerInterface;
use function GuzzleHttp\Psr7\stream_for;

class Handler
{

    /**
     * @var
     */
    private $status;

    /**
     * @var
     */
    private $handler;

    /**
     * @var
     */
    private $vars;


    /**
     * @var \FastRoute\Dispatcher\GroupCountBased
     */
    private $router;

    /**
     * @var Request
     */
    private $request;


    /**
     * @var
     */
    private $response;

    /**
     * @var ContainerInterface
     */
    private $container;


    /**
     * Handler constructor.
     * @param GroupCountBased $router
     * @param Request $request
     * @param Response $response
     */
    public function __construct(GroupCountBased $router, Request $request, Response $response)
    {
        $this->container = container();
        $this->router = $router;
        $this->request = $request;
        $this->response = $response;

        $this->formattingData();
    }


    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @param Request $request
     */
    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     */
    public function setResponse($response): void
    {
        $this->response = $response;
    }

    /**
     *
     */
    public function handle(): void
    {
        try {
            switch ($this->status) {
                case \FastRoute\Dispatcher::NOT_FOUND:
                    $this->handlerNotFound();
                    break;
                case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                    $this->handlerNotAllowed();
                    break;
                case \FastRoute\Dispatcher::FOUND:
                    $this->handlerFound();
                    break;
            }
        } catch (\Exception $e) {
            $this->handlerServerError($e);
        }


    }


    /**
     * @return array
     */
    private function buildRouteInfo(): array
    {
        $method = $this->getMethod();
        $uri = $this->getUri();
        $uri = $this->clearUrl($uri);

        return $this->router->dispatch($method, $uri);
    }

    private function clearUrl(string $url): string
    {
        $position = strpos($url, '?');

        return $position ? substr($url, 0, $position) : $url;

    }

    /**
     *
     */
    private function formattingData(): void
    {
        $routeInfo = $this->buildRouteInfo();

        $this->status = $routeInfo[0];
        $this->handler = $routeInfo[1];
        $this->vars = $routeInfo[2];
    }

    /**
     * @return string
     */
    private function getMethod(): string
    {
        return $this->request->getMethod();
    }

    /**
     * @return \GuzzleHttp\Psr7\Uri|\Psr\Http\Message\UriInterface|string
     */
    private function getUri(): string
    {
        return $this->request->getUri();
    }

    /**
     *
     */
    private function handlerFound(): void
    {
        [$controller, $method] = explode('@', $this->handler);
        $this->response = $this->response->withStatus(200);

        $this->request->set('controller', $controller);
        $this->request->set('method', $method);
    }

    /**
     *
     */
    private function handlerNotAllowed(): void
    {
        $this->response = $this->response
            ->withHeader('Content-Type', 'text/html; charset=UTF-8')
            ->withStatus(405);
    }

    /**
     *
     */
    private function handlerNotFound(): void
    {

        $this->response = $this->response->withStatus(200);
        $this->request->setHandler($this->handler, $this->vars);

    }

    /**
     * @param \Exception $e
     */
    private function handlerServerError(\Exception $e): void
    {
        $this->response = $this->response
            ->withHeader('Content-Type', 'text/html; charset=UTF-8')
            ->withBody(stream_for($e->getMessage()))
            ->withStatus(500);
    }

}
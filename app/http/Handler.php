<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 27.10.18
 * Time: 1:35
 */

namespace App\Http;


use App\Exceptions\NotFoundException;
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
    private $method;


    /**
     * @var
     */
    private $controller;

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
    public function __construct(GroupCountBased $router)
    {
        $this->container = container();
        $this->router = $router;

        $this->formattingData();
    }


    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param mixed $response
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     *
     */
    public function handle(): void
    {
        try {
            switch ($this->status) {
                case \FastRoute\Dispatcher::NOT_FOUND:
                    throw new NotFoundException('Not found route for url - '. $this->getUri());
                    break;
                case \FastRoute\Dispatcher::FOUND:
                    $this->handlerFound();
                    break;
            }
        } catch (\Exception $e) {
            throw $e;
        }


    }


    /**
     * @return array
     */
    private function buildRouteInfo(): array
    {
        $method = $this->getRequestMethod();
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
    private function getRequestMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**1
     * @return \GuzzleHttp\Psr7\Uri|\Psr\Http\Message\UriInterface|string
     */
    private function getUri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     *
     */
    private function handlerFound(): void
    {
        [$controller, $method] = explode('@', $this->handler);

        $this->controller = $controller;
        $this->method = $method;
    }



}
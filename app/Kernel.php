<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 25.02.20
 * Time: 10:08
 */

namespace App;

use App\Http\Handler;

class Kernel
{

    /**
     * @var
     */
    private $builder;

    /**
     * @var
     */
    private $handler;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var Response
     */
    private $response;

    /**
     * @var MiddlewareMediator
     */
    private $mediator;

    /**
     * @var
     */
    private $controller;

    /**
     * Kernel constructor.
     * @param RelayBuilder $builder
     * @param Handler $handler
     * @param MiddlewareMediator $mediator
     */
    public function __construct(Handler $handler)
    {
        $this->handler =  $handler;
    }

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function run()
    {
        $this->runHandler();

        try {

            $controller = container()->get($this->request->get('controller'));
            $this->response = $controller->{$this->request->get('method')}();
        } catch (\Exception $e) {

             $this->response = $this->response->withStatus(500)
                ->withStrToBody($e->getMessage() . '</br>' . $e->getTraceAsString());
        }


        $this->response->send();
        ob_end_flush();
    }

    /**
     *
     */
    private function runHandler(): void
    {
        $this->handler->handle();
        $this->response = $this->handler->getResponse();
        $this->request = $this->handler->getRequest();
    }
}
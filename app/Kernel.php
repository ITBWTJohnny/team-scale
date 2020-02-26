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
    private $handler;

    /**
     * Kernel constructor.
     * @param Handler $handler
     */
    public function __construct(Handler $handler)
    {
        $this->handler =  $handler;
    }

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Exception
     */
    public function run()
    {
        $this->handler->handle();
        $controller = $this->handler->getController();
        $method = $this->handler->getMethod();

        try {
            $controller = container()->get($controller);
            $controller->{$method}();
        } catch (\Exception $e) {
            dd($e);
        }

        ob_end_flush();
    }

}
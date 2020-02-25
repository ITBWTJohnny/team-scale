<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 25.02.20
 * Time: 16:59
 */

namespace App\Controllers;


use App\Http\Request;
use App\Http\Response;

class MainController
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var Response
     */
    private $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function form()
    {
        include_once __ROOT__ .'/resources/form.php';
        return $this->response;
    }
}
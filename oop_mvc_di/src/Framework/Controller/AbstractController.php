<?php

namespace Framework\Controller;


use Framework\Http\RequestInterface;
use Framework\View\ViewInterface;

class AbstractController
{
    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var ViewInterface
     */
    protected $view;

    public function __construct(\Framework\Http\Request $request, \Framework\View\PhpView $view)
    {
        $this->request = $request;
        $this->view    = $view;
    }

    /**
     * @return RequestInterface
     */
    protected function getRequest()
    {
        return $this->request;
    }
}
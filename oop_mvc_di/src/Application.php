<?php

class Application
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var RequestInterface
     */
    private $request;

    private $view;


    public function __construct(
        \Framework\Router\Router $router,
        \Framework\View\PhpView $view,
        \Framework\Http\Request $request)
    {
        $this->router = $router;
        $this->view   = $view;
        $this->request = $request;
    }

    public function run()
    {
        $this->router->dispatch($this->request, $this->view);
    }
}
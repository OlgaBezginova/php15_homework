<?php


namespace Framework\Router;

use Framework\Http\RequestInterface;
use Framework\View\ViewInterface;

interface RouterInterface
{
    /**
     * @param RequestInterface $request
     * @param ViewInterface $view
     *
     * @return string
     */
    public function dispatch(RequestInterface $request, ViewInterface $view);

    /**
     * @param string $url
     *
     * @return array
     */
    public function match(string $url);
}
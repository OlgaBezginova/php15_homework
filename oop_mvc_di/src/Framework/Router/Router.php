<?php

namespace Framework\Router;

use Controller\Index;
use Controller\Text;
use Framework\Controller\NotFoundController;
use Framework\Http\RequestInterface;
use Framework\View\ViewInterface;

class Router implements RouterInterface
{
    public function match($url)
    {
        $controller = 'index';
        $action     = 'index';

        $parts = explode('?', $url);

        $uriParts = explode('/', $parts[0]);

        if (!empty($uriParts[1])) {
            $controller = $uriParts[1];
        }

        if (!empty($uriParts[2])) {
            $action = $uriParts[2];
        }

        return [
            'controller' => $controller,
            'action'     => $action
        ];
    }

    public function dispatch(RequestInterface $request, ViewInterface $view)
    {
        $data = $this->match($request->getRequestUri());

        $controller = sprintf("Controller\\%s", ucfirst($data['controller']));
        $action = $data['action'];

        $objectManager = \ObjectManager::getObjectManager();

        if (class_exists($controller)) {
            $controller = $objectManager->create($controller);
        } else {
            $controller = $objectManager->create(NotFoundController::class);
        }

        $response = $controller->$action();

        echo $response;
    }

    private function parseRequestUri()
    {
        $requestUri = $this->params['REQUEST_URI'];
    }
}
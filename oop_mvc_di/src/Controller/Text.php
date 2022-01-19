<?php

namespace Controller;

use Framework\Controller\AbstractController;
use Model\TextModel;

class Text extends AbstractController
{
    public function index()
    {
        $objectManager = \ObjectManager::getObjectManager();
        $text = $objectManager->create(TextModel::class);

        return $this->view->generate('framework/text.phtml', ['text' => $text->getText()]);
    }
}
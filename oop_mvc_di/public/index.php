<?php

require_once __DIR__.'/../app/bootstrap.php';

$objectManager = ObjectManager::getObjectManager();

$app = $objectManager->create(Application::class);

$app->run();
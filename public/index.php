<?php

$mainApplicationFile = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'engine' . DIRECTORY_SEPARATOR . 'App.php';

require_once($mainApplicationFile);

$app = new \IQU\App();
$app->init();
$app->run();
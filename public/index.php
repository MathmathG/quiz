<?php

require(__DIR__.'/../vendor/autoload.php');

session_start();
//J'importe ma class Application

use Oquiz\Application;

$app = new Application();

//J'appelle la méthode "run"

$app->run();

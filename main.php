<?php

use Acme\SayHelloCommand;
use Acme\RenderCommand;
use Acme\InfoPelicula;
use Symfony\Component\Console\Application;


require 'vendor/autoload.php';

$app = new Application('Commands','1.0');

$app->add(new SayHelloCommand);
$app->add(new RenderCommand);
$app->add(new InfoPelicula);


$app->run();
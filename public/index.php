<?php

$loader = require __DIR__ . "/../vendor/autoload.php";

$app = new Silex\Application();

$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates/twig/');

$twig = new Twig_Environment($loader, array(
    //'cache' => __DIR__.'/../var/cache/twig',
));

$parsedown = new Parsedown();

$website = new \Devell\Website($twig, $parsedown, __DIR__.'/../data/texts/');

$app->get('/{page}', function ($name) use($website) {
    return $website->render('pages/'.$name);
});

$app->get('/', function () use($website) {
    return $website->render('pages/index');
});

$app['debug'] = true;


$app->run();

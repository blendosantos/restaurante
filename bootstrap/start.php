<?php

$app = new Illuminate\Foundation\Application;

$env = $app->detectEnvironment(array(
    'Dev' => array('Blendo', 'DTS-00099', 'TI-00001', '*.dev'),
    'local' => array('Mario'),
        ));

$app->bindInstallPaths(require __DIR__ . '/paths.php');

$framework = $app['path.base'] .
        '/vendor/laravel/framework/src';

require $framework . '/Illuminate/Foundation/start.php';

return $app;

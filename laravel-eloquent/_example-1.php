<?php

spl_autoload_register(function ($class_name) {
    $class_name = strtr($class_name, ['Prototype\\LaravelEloquent\\' => '' ,'\\' => '/' ]);
    include $class_name . '.php';
});


$manager = new \Prototype\LaravelEloquent\Manager();
$manager->addConnection(['host' => 'host', 'login' => 123, 'password' => 123]); // default
$manager->addConnection(['host' => 'host', 'login' => 123, 'password' => 123], 'custom-123');
$manager->globalize();
$manager->bootstrap();

$result[] = \Prototype\LaravelEloquent\Product::sendRequest(['xxx', 'yyyy']);
$result[] = \Prototype\LaravelEloquent\Product::create(['id' => 123, 'name' => 'name-123']);

print_r($result);

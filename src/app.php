<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 3/25/2015
 * Time: 8:18 PM
 */
require '../vendor/autoload.php';

$app = new \Slim\Slim();
$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});
$app->get('/', function()
{
    echo "welcome";
});

$app->post('/auth', function()
{
    echo 'hello'.$_POST['username'];
});

$app->run();
<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 3/25/2015
 * Time: 8:18 PM
 */


$app = new \Slim\Slim();

$app->get('/', function()
{
    $startPrompt = new \views\LoginForm();
    $startPrompt->show();
});

$app->post('/auth', function()
{
    new \views\Verify();
});

$app->post('/api/auth', function()
{

        $try = new \Common\Authentication\SqLite();

        $try->authenticate($_POST['username'],$_POST['password']);
});

$app->run();
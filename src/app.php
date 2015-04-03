<?php


$app = new \Slim\Slim();

$app->get('/', function()
{
    require_once '../src/views/LoginHtml.html';
    //$startPrompt = new \views\LoginForm();
    //$startPrompt->show();
});

$app->post('/auth', function()
{
    new \views\Verify();
});

$app->post('/api/auth', function() use ($app)
{

    $try = new \Common\Authentication\SqLite();
    $x = $try->authenticate($_POST['username'],$_POST['password']);

    if ($x === 1)
    {
        echo $app->response()->setStatus(200);
        echo $app->response()->getStatus();

    }

    else
    {

        echo $app->response()->setStatus(404);
        echo $app->response()->getStatus();
    }


});

$app->run();
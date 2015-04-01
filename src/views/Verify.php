<?php
namespace views;


use Common\Authentication\SqLite;
use Slim\View;


class Verify extends View
{
    public function __construct()
    {
        $this->content = <<<LOGIN_FORM
        <!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Verify Form</title>
    </head>
    <body>
    <link rel="stylesheet" type="text/css" href="style.css">
        <div align="center">

LOGIN_FORM;


        $this->show();
        $authorize='';

        if ($_POST['authType'] === "api")
        {
            $authorize = new InMemory();

        }


        if ($_POST['authType'] === "lite")
        {
            $authorize = new SqLite();

        }
        $authorize->authenticate($_POST['username'],$_POST['password']);
        echo "</div>
</body>
</html>";

    }
}
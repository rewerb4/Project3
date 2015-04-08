<?php
ini_set('display_errors', 'On');

use Libraries\Authentication\InSQLite;

require 'vendor/autoload.php';
require 'libraries/IAuthentication.php';
require 'libraries/InSQLite.php';

$app = new \Slim\Slim();

$app->post('/auth', function() {
	$inSqlLite = new InSQLite($_POST);
	$inSqlLite->authenticate();
});

$app->post('/new_user', function() {
	$inSqlLite = new InSQLite($_POST);
	$inSqlLite->create();
});

$app->run();

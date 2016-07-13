<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('config.php');
require_once('modules/Core.php');

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$mysqli->set_charset("utf8");

if ($mysqli->connect_error) {
    printf('Connection error: %s\n', $mysqli->connect_error);
    exit();
}

ActiveRecord::$mysqli = $mysqli;
$Core = new Core($mysqli);

$Context = array();

$Context['Core'] = $Core->getData();
$Context['articles'] = Article::all();

TemplateSystem::setTemplate('themes/' . $Core->theme);
TemplateSystem::setContext($Context);

$router = new Router();

$router->attachRoute(new Route('/users', 'UsersController::all'));
$router->attachRoute(new Route('/users.:ext', 'UsersController::all'));
$router->attachRoute(new Route('/users/:id.:ext', 'UsersController::one'));
$router->attachRoute(new Route('/', 'ArticlesController::all'));
$router->attachRoute(new Route('/.:ext', 'ArticlesController::all'));
$router->attachRoute(new Route('/:alias.:ext', 'ArticlesController::one'));

$router->go();
$mysqli->close();

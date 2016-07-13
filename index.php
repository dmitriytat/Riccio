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
$Context['assets'] = 'themes/' . $Core->theme;

TemplateSystem::setTemplate('themes/' . $Core->theme);
TemplateSystem::setContext($Context);

$router = new Router();

//Message::sync(true);
//
//function generateRandomString($length = 10)
//{
//    $characters = '      0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//    $charactersLength = strlen($characters);
//    $randomString = '';
//    for ($i = 0; $i < $length; $i++) {
//        $randomString .= $characters[rand(0, $charactersLength - 1)];
//    }
//    return $randomString;
//}
//
//for ($i = 0; $i < 10; $i++) {
//    $message = new Message(array('article' => random_int(1, 2), 'text' => generateRandomString(140)));
//    $message->save();
//}

$router->attachRoute(new Route('/users', 'UsersController::all'));
$router->attachRoute(new Route('/users.:ext', 'UsersController::all'));
$router->attachRoute(new Route('/users', 'UsersController::new', 'POST'));
$router->attachRoute(new Route('/users.:ext', 'UsersController::new', 'POST'));
$router->attachRoute(new Route('/users/:id.:ext', 'UsersController::one'));
$router->attachRoute(new Route('/', 'ArticlesController::all'));
$router->attachRoute(new Route('/.:ext', 'ArticlesController::all'));
$router->attachRoute(new Route('/:alias.:ext', 'ArticlesController::one'));

$router->go();
$mysqli->close();

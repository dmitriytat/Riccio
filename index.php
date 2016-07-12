<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

require_once('config.php');
require_once('modules/Core.php');

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$mysqli->set_charset("utf8");
if ($mysqli->connect_error) {
    printf('Connection error: %s\n', $mysqli->connect_error);
    exit();
}

$Core = new Core($mysqli);
$Context = array();

$template = 'themes/' . $Core->theme;

TemplateSystem::setTemplate($template);

$Context['Core'] = $Core->getData();

$Article = new Article($Core, $mysqli);
$Context['Menu']['Items'] = $Article->getArticle(array('id', 'title', 'alias'), null, 10);
$Context['List']['Items'] = $Article->getArticle(null, null, 10);

if (isset($_GET['alias']) && $_GET['alias'] != '') {
    $Context['Article'] = $Article->getArticle(array(), array('alias' => $_GET['alias']));

    if (isset($_GET['mode']) && $_GET['mode'] == 'json') {
        $select = isset($_GET["select"]) ? explode(",", $_GET["select"]) : null;
        $dat = $Article->getArticle($select, array('alias' => $_GET["alias"]), isset($_GET["limit"]) ? $_GET["alias"] : 1);


        echo json_encode($dat);
    } else {
        $Context['Page']['title'] = $Context['Article']['title'];
        echo TemplateSystem::render('single.tpl', $Context);
    }
} else {
    $Context['Page']['title'] = $Context['Core']['title'];
    echo TemplateSystem::render('index.tpl', $Context);
}

$mysqli->close();

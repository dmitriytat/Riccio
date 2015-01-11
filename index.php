<?php
define('ST_T', microtime());

require_once 'config.php';
require_once 'modules/Core.php';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($mysqli->connect_error) {
    printf('Connection error: %s\n', $mysqli->connect_error);
    exit();
}

$Core = new Core($mysqli);
$template = 'themes/' . $Core->theme;
TemplateSystem::setTemplate($template);

$Context = array();
$Context['Core'] = $Core->getData();


$Article = new Article($mysqli);
$Context['Menu']['Items'] = $Article->getArticle(array('id','title','alias'), null,10) ;
$Context['List']['Items'] = $Article->getArticle(null, null,10) ;

if (isset($_GET['alias']) && $_GET['alias'] != '') {
    $Context['Article'] = $Article->getArticle(array(), array('alias'=>$_GET['alias'])) ;

    if (isset($_GET['mode']) && $_GET['mode'] == 'json') {
        $select = isset($_GET["select"]) ? explode(",", $_GET["select"]) : null;
        $dat = $Article->getArticle($select, array('alias'=>$_GET["alias"]), isset($_GET["limit"]) ? $_GET["alias"] : 1);


        echo json_encode($dat);
    } else {
        $Context['Page']['title'] = $Context['Article']['title'];
        echo TemplateSystem::showPage('single.tpl', $Context);
    }
}
else {
    $Context['Page']['title'] = $Context['Core']['title'];
    echo TemplateSystem::showPage('index.tpl', $Context);
}

$mysqli->close();
printf('<!-- Страница сгенерирована за %.5f сек. -->', microtime() - ST_T);
?>
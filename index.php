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
$template = 'themes/' . $Core->theme . '/';
TemplateSystem::setTemplate($template);

//if (isset($_GET['alias']) && $_GET['alias'] != '') {
//    $Article = new Article($mysqli, $_GET['alias']);
//    $json_data = json_encode($Article);
//    if (isset($_GET['mode']) && $_GET['mode'] == 'json') {
//        echo $json_data;
//    } else {
//        TemplateSystem::printPage($_GET['alias']+'.tpl', $json_data);
//    }
//}
$Context = '{
  "Library": {
    "jquery": "http://yastatic.net/jquery/1.11.1/jquery.min.js"
  }
}';
    $Context = json_decode($Context, true);
    $Context['Core'] = $Core->data;
    $m = new Article($mysqli,'');
    $m->readList('article');
    $Context['Menu']['Items'] = $m->data ;
    $Context = json_encode($Context);
if (isset($_GET['alias']) && $_GET['alias'] != '') {
    $Context = json_decode($Context, true);
    $d = new Article($mysqli, $_GET['alias']);
    $Context['Article'] = $d->data;
    $Context = json_encode($Context);
    if (isset($_GET['mode']) && $_GET['mode'] == 'json') {
        echo $Context;
    } else {
        echo TemplateSystem::getPage('content.tpl', $Context);
    }
}
else {
    echo TemplateSystem::getPage('index.tpl', $Context);
}

$mysqli->close();
printf('<!-- Страница сгенерирована за %.5f сек. -->', microtime() - ST_T);
?>
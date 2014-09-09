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

$version[] = 'Система событий';
$version[] = 'Система шаблонов';
$version[] = 'Подключение плагинов';
TemplateSystem::addList('other_version', 'Реализовано', $version);

TemplateSystem::assignToHome('lib_jquery', $Core->js . '/lib/jquery-2.0.3.min.js');
TemplateSystem::assignToHome('core_template', $template);
$User = new User($mysqli, "root", "pswd");
if (isset($_GET['content'])) {
    if (isset($_POST['edit'])) {
        $Article = new Article($mysqli, $_GET['content']);
        $Article->data[$_POST['field']]=$_POST['value'];
        $Article->write();
        echo $Article->data[$_POST['field']];
    } else {
        $Article = new Article($mysqli, $_GET['content']);
        TemplateSystem::showPage_new('content.tpl');
    }
} elseif (isset($_GET['page'])) {
    if ($_GET['page'] == 'tdata')
        TemplateSystem::showData();
    elseif ($_GET['page'] != '')
        TemplateSystem::showPage_new($_GET['page'] . '.tpl');
} else
    TemplateSystem::showPage_new('index.tpl');

$mysqli->close();
printf('<!-- Страница сгенерирована за %.5f сек. -->', microtime()-ST_T);
?>
<?php
require_once 'config.php';
require_once 'modules/Core.php';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (mysqli_connect_errno()) {
    printf('Ошибка соединения: %s\n', mysqli_connect_error());
    exit();
}
$Core = new Core($mysqli);
$template = $Core->theme . '/';
TemplateSystem::setTemplate($template);

$version[] = 'Система событий';
$version[] = 'Система шаблонов';
$version[] = 'Подключение плагинов';
TemplateSystem::addList('version', 'Реализовано', $version);

TemplateSystem::assignToHome('jquery', $Core->js . '/lib/jquery-2.0.3.min.js');
TemplateSystem::assignToHome('template', $template);

if (isset($_GET['content'])) {
    $Article = new Article($mysqli, $_GET['content']);
    TemplateSystem::assign("Atitle", $Article->title);
    TemplateSystem::assign("Akeywords", $Article->keywords);
    TemplateSystem::assign("Adescription", $Article->description);
    TemplateSystem::assign("Acontent", $Article->content);
    TemplateSystem::showPage_new('content.tpl');
} elseif (isset($_GET['page'])) {
    if ($_GET['page'] == 'tdata')
        TemplateSystem::showData();
    elseif ($_GET['page'] != '')
        TemplateSystem::showPage_new($_GET['page'] . '.tpl');
} else
    TemplateSystem::showPage_new('index.tpl');

?>
<?php

require_once "modules/Core.php";

$mysqli = new mysqli("localhost", "root", "star", "riccio");

if (mysqli_connect_errno()) {
    printf("Ошибка соединения: %s\n", mysqli_connect_error());
    exit();
}

$Core = new Core($mysqli);
TemplateSystem::setTemplate("theme");


$version[] = "Система событий";
$version[] = "Система шаблонов";
$version[] = "Подключение плагинов";
TemplateSystem::addList("version", "Реализовано", $version);

if (isset($_GET['page']) && $_GET['page'] != '')
    TemplateSystem::showPage_new($_GET['page'] . ".tpl");
else
    TemplateSystem::showPage_new("index.tpl");
?>
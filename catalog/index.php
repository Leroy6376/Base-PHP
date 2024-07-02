<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';
redirectIsNotAuthorized('/login/');

$cars = getCars();

includeTemplate('layout/header.php', ['title' => 'Каталог']);
includeTemplate('catalog/cars_catalog.php', ['cars' => $cars]);
includeTemplate('layout/footer.php');

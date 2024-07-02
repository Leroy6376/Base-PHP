<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';
redirectIsNotAuthorized('/login/');
$user = getUserProfile($_SESSION['user']['id']);
$groups = getUserGroups($_SESSION['user']['id']);

includeTemplate('layout/header.php', ['title' => 'Личный кабинет']);
includeTemplate('profile/userProfile.php', ['user' => $user]);
includeTemplate('profile/userGroup.php', ['groups' => $groups]);
includeTemplate('layout/footer.php');

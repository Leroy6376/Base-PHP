<?php
session_start();

require 'includeTemplate.php';
require 'stringFormat.php';
require 'arraySort.php';
require 'getMenu.php';
require 'isCurrentUrl.php';
require 'getCars.php';
require 'formatPrice.php';
require 'authorization.php';
require 'cookies.php';
require 'database.php';
require 'users.php';

if (isAuthorized()) {
    setEmailCookie(currentUser()['email']);
}

if (isset($_GET['logout']) && $_GET['logout'] === 'yes') {
    logout();
}

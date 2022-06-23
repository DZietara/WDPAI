<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('sets', 'SetsController');
Router::post('addSet', 'SetsController');
Router::get('learn', 'DefaultController');
Router::get('settings', 'DefaultController');
Router::get('register', 'SecurityController');
Router::post('login', 'SecurityController');
Router::post('logout', 'SecurityController');

Router::run($path);

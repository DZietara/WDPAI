<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('test', 'DefaultController');

Router::get('sets', 'SetsController');
Router::post('addSet', 'SetsController');
Router::get('deleteSet', 'SetsController');
Router::post('search', 'SetsController');
Router::get('card', 'CardsController');

Router::get('register', 'SecurityController');
Router::post('login', 'SecurityController');
Router::post('logout', 'SecurityController');
Router::get('admin', 'SecurityController');
Router::post('searchUser', 'SecurityController');
Router::get('deleteUser', 'SecurityController');

Router::run($path);

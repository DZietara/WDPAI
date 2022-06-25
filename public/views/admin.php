<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/admin.css">
    <script type="text/javascript" src="./public/js/user.js" defer></script>
    <title>eFlashcards</title>
</head>

<body>
<div class="base-container">
    <nav>
        <div class="logo-container">
            <img class="logo" src="public/img/logo.svg">
        </div>
        <div class="user-container">
            <img class="user" src="public/img/user.png">
            <span id="username"><?php echo $_SESSION["name"]; ?></span>
        </div>
        <ul class="menu-list">
            <li>
                <a href="/sets">Sets</a>
            </li>
            <li>
                <a href="/test">Test</a>
            </li>
            <?php
            if($_SESSION['role'] == 'admin') {
                ?>
                <li>
                    <a href="/admin">Admin panel</a>
                </li>
                <?php
            }
            ?>
            <li>
                <a href="/logout">Logout</a>
            </li>
        </ul>
    </nav>

    <main>
        <header>
            <div class="header-container">
                <span class="title">Admin panel</span>
            </div>
        </header>
        <div class="search-bar">
            <input class="search" placeholder="search user">
        </div>
        <div class="messages">
            <?php if(isset($messages)) {
                foreach ($messages as $message){
                    echo $message;
                }
            }
            ?>
        </div>
        <section class="section-container">
            <?php foreach ($admin as $user): ?>
            <div class="users" id="<?= $user->getId(); ?>">
                <span class="user-info" id="user-id">ID: <?= $user->getId(); ?></span>
                <span class="user-info" id="user-name"> NAME: <?= $user->getName(); ?></span>
                <span class="user-info" id="user-surname"> SURNAME: <?= $user->getSurname(); ?></span>
                <span class="user-info" id="user-email">  EMAIL: <?= $user->getEmail(); ?></span>
                <button id="delete-button">delete</button>
            </div>
            <?php endforeach; ?>
        </section>
    </main>
</div>

</body>
</html>

<template id="user-template">
    <div class="users" id="">
        <span class="user-info" id="user-id"></span>
        <span class="user-info" id="user-name"> </span>
        <span class="user-info" id="user-surname"></span>
        <span class="user-info" id="user-email"></span>
        <button id="delete-button">delete</button>
    </div>
</template>
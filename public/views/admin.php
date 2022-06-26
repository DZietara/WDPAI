<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/admin.css">
    <script type="text/javascript" src="./public/js/user.js" defer></script>
    <script src="https://kit.fontawesome.com/ad3f96515e.js" crossorigin="anonymous"></script>
    <title>eFlashcards</title>
</head>

<body>
<div class="base-container">
    <?php include("navbar.php") ?>
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
            <?php if (isset($messages)) {
                foreach ($messages as $message) {
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
                    <button id="delete-button" class="del">delete</button>
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
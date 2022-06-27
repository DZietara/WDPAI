<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/admin.css">
    <script type="text/javascript" src="./public/js/set.js" defer></script>
    <script src="https://kit.fontawesome.com/ad3f96515e.js" crossorigin="anonymous"></script>
    <title>eFlashcards</title>
</head>

<body>
<div class="base-container">
    <?php include("navbar.php") ?>
    <main>
        <header>
            <div class="header-container">
                <span class="title">Sets</span>
                <button class="add-flashcard" onclick="location.href='/addSet';"><i class="fa-solid fa-plus"></i> Add Set</button>
            </div>
        </header>
        <div class="search-bar">
            <input class="search" placeholder="search set">
        </div>
        <section class="section-container">
            <?php foreach ($sets as $set): ?>
                <div class="flashcard" id="<?= $set->getId(); ?>">
                    <span class="flashcard-category"><?= $set->getName(); ?></span>
                    <button id="delete-button">delete</button>
                </div>
            <?php endforeach; ?>
        </section>
    </main>
</div>

</body>
</html>

<template id="set-template">
    <div class="flashcard" id="">
        <span class="flashcard-category">category</span>
        <button id="delete-button">delete</button>
    </div>
</template>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
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
                    <a href="/learn">Learn</a>
                </li>
                <?php
                    if($_SESSION['role'] == 'admin') {
                ?>
                <li>
                    <a href="/settings">Settings</a>
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
                    <span class="title">Sets</span>
                    <button class="add-flashcard" onclick="location.href='/addSet';"> Add Set</button>
                </div>
                
            </header>
            <section class="section-container">
                <?php foreach ($sets as $set): ?>
                <div class="flashcard">
                    <span class="flashcard-category"><?= $set->getName(); ?></span>
                    <span class="category-terms">x terms</span>
                </div>
                <?php endforeach; ?>
            </section>
        </main>
    </div>

</body>

</html>
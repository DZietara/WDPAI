<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/card.css">
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <script type="text/javascript" src="./public/js/deleteSet.js" defer></script>
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
            if ($_SESSION['role'] == 'admin') {
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
                <span class="title">Cards</span>
            </div>

        </header>
        <section class="section-container-cards">
            <?php foreach ($cards as $card): ?>
                <div class="cards">
                    <span class="card"><?= $card->getAnswer(); ?></span>
                    <span class="card"><?= $card->getQuestion(); ?></span>
                </div>
            <?php endforeach; ?>
        </section>
    </main>
</div>

</body>
</html>
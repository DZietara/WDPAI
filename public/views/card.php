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
    <?php include("navbar.php") ?>
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
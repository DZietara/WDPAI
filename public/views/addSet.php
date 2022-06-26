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
    <?php include("navbar.php") ?>
    <main>
        <header>
            <div class="header-container">
                <span class="title">Add Set</span>
            </div>

        </header>
        <section id="add-set-container">
            <div class="messages">
                <?php if (isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>
            <form class="add-set-form" method="POST" action="addSet">
                <input class="add-set-input" maxlength="30" name="setName" id="set-name-input" type="text"
                       placeholder="Set Name">
                <div id="set">
                    <input class="add-set-input" maxlength="255" name="question[]" type="text" placeholder="question">
                    <input class="add-set-input" maxlength="255" name="answer[]" type="text" placeholder="answer">
                    <input class="add-set-input" maxlength="255" name="question[]" type="text" placeholder="question">
                    <input class="add-set-input" maxlength="255" name="answer[]" type="text" placeholder="answer">
                    <input class="add-set-input" maxlength="255" name="question[]" type="text" placeholder="question">
                    <input class="add-set-input" maxlength="255" name="answer[]" type="text" placeholder="answer">
                    <input class="add-set-input" maxlength="255" name="question[]" type="text" placeholder="question">
                    <input class="add-set-input" maxlength="255" name="answer[]" type="text" placeholder="answer">
                    <input class="add-set-input" maxlength="255" name="question[]" type="text" placeholder="question">
                    <input class="add-set-input" maxlength="255" name="answer[]" type="text" placeholder="answer">
                    <input class="add-set-input" maxlength="255" name="question[]" type="text" placeholder="question">
                    <input class="add-set-input" maxlength="255" name="answer[]" type="text" placeholder="answer">
                    <input class="add-set-input" maxlength="255" name="question[]" type="text" placeholder="question">
                    <input class="add-set-input" maxlength="255" name="answer[]" type="text" placeholder="answer">
                    <input class="add-set-input" maxlength="255" name="question[]" type="text" placeholder="question">
                    <input class="add-set-input" maxlength="255" name="answer[]" type="text" placeholder="answer">
                    <input class="add-set-input" maxlength="255" name="question[]" type="text" placeholder="question">
                    <input class="add-set-input" maxlength="255" name="answer[]" type="text" placeholder="answer">
                    <input class="add-set-input" maxlength="255" name="question[]" type="text" placeholder="question">
                    <input class="add-set-input" maxlength="255" name="answer[]" type="text" placeholder="answer">
                </div>
                <button id="add-set-button" type="submit">Add Set</button>
                <div class="controls">
                    <a href="#" id="add_more_fields">Add Field</a>
                    <a href="#" id="remove_fields">Remove Field</a>
                </div>
            </form>
            <script type="text/javascript" src="./public/js/addset.js"></script>

        </section>
    </main>
</div>

</body>

</html>
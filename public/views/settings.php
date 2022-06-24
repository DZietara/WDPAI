<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/settings.css">
    <script type="text/javascript" src="./public/js/searchUser.js" defer></script>
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
                <span class="title">Settings</span>
            </div>
        </header>
        <div class="search-bar">
            <input class="search" placeholder="search user">
        </div>

        <section class="section-container">
            <?php foreach ($settings as $user): ?>
            <div class="users">
                <table>
                    <tr>
                        <td>ID: </td> <td><?= $user->getId(); ?></td>
                    </tr>
                    <tr>
                        <td>NAME: </td> <td><?= $user->getName(); ?></td>
                    </tr>
                    <tr>
                        <td> SURNAME: </td> <td><?= $user->getSurname(); ?></td>
                    </tr>
                    <tr>
                        <td>EMAIL: </td> <td><?= $user->getEmail(); ?></td>
                    </tr>
                </table>
            </div>
            <?php endforeach; ?>

        </section>
    </main>
</div>

</body>

</html>

<template id="user-template">
    <div class="users">
        <table>
            <tr>
                <td>ID: </td> <td class="user-id"></td>
            </tr>
            <tr>
                <td>NAME: </td> <td class="user-name"></td>
            </tr>
            <tr>
                <td> SURNAME: </td> <td class="user-surname"></td>
            </tr>
            <tr>
                <td>EMAIL: </td> <td class="user-email"></td>
            </tr>
        </table>
    </div>
</template>
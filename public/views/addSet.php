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
                <span class="title">Add Set</span>
            </div>

        </header>
        <section id="add-set-container">
            <div class="messages">
                <?php if(isset($messages)) {
                    foreach ($messages as $message){
                        echo $message;
                    }
                }
                ?>
            </div>
            <form class="add-set-form" method="POST" action="addSet">
                <table>
                    <tr>
                        <td colspan="2"><input name="setName" type="text" placeholder="Set Name"></td>
                    </tr>
                    <tr>
                        <td><input name="q1" type="text" placeholder="question"></td>
                        <td><input name="a1" type="text" placeholder="answer"></td>
                    </tr>
                    <tr>
                        <td><input name="q2" type="text" placeholder="question"></td>
                        <td><input name="a2" type="text" placeholder="answer"></td>
                    </tr>
                    <tr>
                        <td><input name="q3" type="text" placeholder="question"></td>
                        <td><input name="a3" type="text" placeholder="answer"></td>
                    </tr>
                    <tr>
                        <td><input name="q4" type="text" placeholder="question"></td>
                        <td><input name="a4" type="text" placeholder="answer"></td>
                    </tr>
                    <tr>
                        <td><input name="q5" type="text" placeholder="question"></td>
                        <td><input name="a5" type="text" placeholder="answer"></td>
                    </tr>
                    <tr>
                        <td><input name="q6" type="text" placeholder="question"></td>
                        <td><input name="a6" type="text" placeholder="answer"></td>
                    </tr>
                    <tr>
                        <td><input name="q7" type="text" placeholder="question"></td>
                        <td><input name="a7" type="text" placeholder="answer"></td>
                    </tr>
                    <tr>
                        <td><input name="q8" type="text" placeholder="question"></td>
                        <td><input name="a8" type="text" placeholder="answer"></td>
                    </tr>
                    <tr>
                        <td><input name="q9" type="text" placeholder="question"></td>
                        <td><input name="a9" type="text" placeholder="answer"></td>
                    </tr>
                    <tr>
                        <td><input name="q10" type="text" placeholder="question"></td>
                        <td><input name="a10" type="text" placeholder="answer"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><button id="add-set-button" type="submit">Add Set</button></td>
                    </tr>
                </table>
            </form>
        </section>
    </main>
</div>

</body>

</html>
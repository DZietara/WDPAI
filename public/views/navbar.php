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
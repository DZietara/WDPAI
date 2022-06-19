<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/login.css">
    <title>register</title>
</head>

<body>
    <div class="container">

        <div class="logo-container">
            <img class="logo" src="public/img/logo.svg">
        </div>
        
        <div class="login-container">
            <div class="message">
                <span id="hello">Hello!</span>
                <span id="hello2">Sign up to Get Started</span>
            </div>
            <form method="POST" action="register">
                <input name="email" type="text" placeholder="Email Address">
                <input name="name" type="text" placeholder="Name">
                <input name="surname" type="text" placeholder="Surname">
                <input name="password" type="password" placeholder="Password">
                <input name="confirmedPassword" type="password" placeholder="Confirm Password">
                <button id="login-button" type="submit">Register</button>
                <span id="bottom-text">Have an account? <a href="/login">Log in</a></span>
                <div class="messages">
                    <?php if(isset($messages)) {
                        foreach ($messages as $message){
                            echo $message;
                        }
                    }
                    ?>
                </div>
            </form>
                
        </div>

    </div>

</body>

</html>

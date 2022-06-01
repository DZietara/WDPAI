<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/login.css">
    <title>login</title>
</head>

<body>
    <div class="container">

        <div class="logo-container">
            <img class="logo" src="public/img/logo.svg">
        </div>
        
        <div class="login-container">
            <div class="message">
                <span id="hello">Log in</span>
            </div>
            <form method="POST" action="login">
                <input name="email" type="text" placeholder="Email Address">
                <input name="password" type="password" placeholder="Password">
                <button id="login-button" type="submit">Log In</button>
                <span id="signup">Don't have an account? <a href="/register">Sign up</a></span>
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

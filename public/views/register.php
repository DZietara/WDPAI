<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/register.css">
    <title>register</title>
</head>

<body>
    <div class="container">

        <div class="logo-container">
            <img class="logo" src="public/img/logo.svg">
        </div>
        
        <div class="register-container">
            <div class="message">
                <span id="hello">Hello!</span>
                <span id="hello2">Sign up to Get Started</span>
            </div>
            <form method="POST" action="/register">
                <input name="email" type="text" placeholder="Email Address">
                <input name="name" type="text" placeholder="Name">
                <input name="password" type="password" placeholder="Password">
                <input name="password" type="password" placeholder="Repeat Password">
                <button id="register-button" type="submit">Register</button>
                <span id="login">Have an account? <a href="/login">Log in</a></span>
            </form>
                
        </div>

    </div>

</body>

</html>

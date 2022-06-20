<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController
{
    private $userRepository;
    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login()
    {
        session_start();
        if (!$this->isPost()) {
            session_destroy();
            return $this->render('login');
        }

        $email = $_POST["email"];
        $user = $this->userRepository->getUser($email);

        if (!$user) {
            return $this->render('login', ['messages' => ['User not exist!']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email not exist!']]);
        }

        if (!password_verify($_POST["password"], $user->getPassword())) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        $_SESSION['loggedin'] = true;
        $_SESSION['name'] = $user->getName()." ".$user->getSurname();

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/flashcards");
    }

    public function logout() {
        $url = "http://$_SERVER[HTTP_HOST]";
        if (!$this->isGet()) {
            header("Location: {$url}/login");
            return;
        }
        session_start();
        session_destroy();
        header("Location: {$url}/login");
    }

    public function register()
    {
        session_start();
        if (!$this->isPost()) {
            session_destroy();
            return $this->render('register');
        }

        $email = $_POST['email'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirmedPassword'];

        if ($password !== $confirmedPassword) {
            return $this->render('register', ['messages' => ['Passwords must be the same!']]);
        }

        $user = new User($email, $name, $surname, password_hash($password, PASSWORD_DEFAULT));

        $this->userRepository->addUser($user);

        return $this->render('login', ['messages' => ['You\'ve been succesfully registrated!']]);
    }

}
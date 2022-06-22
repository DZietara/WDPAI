<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Role.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/RoleRepository.php';

class SecurityController extends AppController
{
    private $userRepository;
    private $roleRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->roleRepository = new RoleRepository();
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
        $role = $this->roleRepository->getRoleByUserId($user->getId());

        if (!$user) {
            return $this->render('login', ['messages' => ['User not exist!']]);
        } else if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email not exist!']]);
        } else if (!password_verify($_POST["password"], $user->getPassword())) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        } else if ($_SESSION["loggedin"]) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/flashcards");
        }

        $_SESSION['loggedin'] = true;
        $_SESSION['name'] = $user->getName()." ".$user->getSurname();
        $_SESSION['role'] = $role->getName();

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


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->render('register', ['messages' => ["Invalid email format!"]]);
        }

        if ($this->userRepository->existUserByEmail($email)) {
            return $this->render('register', ['messages' => ['Email is already taken!']]);
        }

        if (!preg_match('/[A-Za-z]+/', $name) || !preg_match('/[A-Za-z]+/', $surname)) {
            return $this->render('register', ['messages' => ['Fill all fields!']]);
        }

        if (strlen($password) < 6) {
            return $this->render('register', ['messages' => ['Password must be at least 6 characters long!']]);
        }

        if ($password !== $confirmedPassword) {
            return $this->render('register', ['messages' => ['Passwords must be the same!']]);
        }

        $user = new User($email, $name, $surname, password_hash($password, PASSWORD_DEFAULT));
        $this->userRepository->addUser($user);

        $addedUser = $this->userRepository->getUser($user->getEmail());
        $this->roleRepository->addRoleByUserId($addedUser->getId());

        return $this->render('login', ['messages' => ['You\'ve been succesfully registrated!']]);
    }

}
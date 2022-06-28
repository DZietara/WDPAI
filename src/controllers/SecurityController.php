<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Role.php';
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../repository/RoleRepository.php';

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

    public function index()
    {
        $this->render('login');
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
        } else if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email not exist!']]);
        } else if (!password_verify($_POST["password"], $user->getPassword())) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        } else if ($_SESSION["loggedin"]) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/sets");
        }

        $role = $this->roleRepository->getRoleByUserId($user->getId());
        $_SESSION['loggedin'] = true;
        $_SESSION['name'] = $user->getName() . " " . $user->getSurname();
        $_SESSION['role'] = $role->getName();
        $_SESSION["userid"] = $user->getId();

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/sets");
    }

    public function logout()
    {
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

    public function searchUser()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->userRepository->getUserBySearch($decoded['search']));
        }
    }

    public function deleteUser()
    {
        if ($_SESSION['role'] == 'admin' && $_GET['id'] != $_SESSION['userid']) {
            $this->userRepository->deleteUserById($_GET['id']);
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/admin");
        }
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/admin");
    }

    public function admin()
    {
        $allUsers = $this->userRepository->getAllUsers();
        $this->render('admin', ['admin' => $allUsers]);
    }

}
<?php

require_once 'AppController.php';

class DashboardController extends AppController {
 
    public function index()
    {
        $this->render("login");
    }

    public function login()
    {
        $this->render("login");
    }

    public function register()
    {
        $this->render("register");
    }

    public function dashboard() {
        // TODO return and render display.html
        $hello = 'Welcome on Dahboard page!';
        return $this->render('dashboard', ['greetings' => $hello]);
    }
}
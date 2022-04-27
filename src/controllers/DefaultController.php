<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function index()
    {
        $this->render("dashboard");
    }

    public function dashboard()
    {
        $this->render("dashboard");
    }
}
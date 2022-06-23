<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    /*
    public function flashcards()
    {
        session_start();
        $this->render("flashcards");
    }*/

    public function learn()
    {
        session_start();
        $this->render("learn");
    }

    public function settings()
    {
        session_start();
        $this->render("settings");
    }
}
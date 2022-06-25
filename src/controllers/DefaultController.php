<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function test()
    {
        session_start();
        $this->render("test");
    }

}

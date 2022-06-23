<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Set.php';
require_once __DIR__.'/../repository/SetRepository.php';

class SetsController extends AppController
{
    private $message = [];
    private $setRepository;

    public function __construct()
    {
        parent::__construct();
        $this->setRepository = new SetRepository();
    }

    public function sets()
    {
        $sets = $this->setRepository->getAllSetsByUser();
        $this->render('sets', ['sets' => $sets]);
    }

}
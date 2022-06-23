<?php

require_once __DIR__.'/../../Database.php';

class Repository {
    protected $database;

    public function __construct() {
        session_start();
        $this->database = new Database();
    }
}
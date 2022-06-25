<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Set.php';
require_once __DIR__ . '/../models/Card.php';
require_once __DIR__ . '/../repository/SetRepository.php';
require_once __DIR__ . '/../repository/CardRepository.php';

class CardsController extends AppController
{
    private $message = [];
    private $setRepository;
    private $cardRepository;

    public function __construct()
    {
        parent::__construct();
        $this->setRepository = new SetRepository();
        $this->cardRepository = new CardRepository();
    }

    public function card()
    {
        $sets = $this->setRepository->getAllSetsByUser();
        if ($this->doesSetBelongToUser($sets, $_GET['id'])) {
            $cards = $this->cardRepository->getAllCardsBySetId($_GET['id']);
            $this->render('card', ['cards' => $cards]);
        } else {
            echo "You are not authorized to view this page";
        }
    }

    public function doesSetBelongToUser($sets, $setId): bool
    {
        foreach ($sets as $set) {
            if ($set->getId() == $setId) {
                return true;
            }
        }
        return false;
    }
}

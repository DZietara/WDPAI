<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Set.php';
require_once __DIR__ . '/../repository/SetRepository.php';
require_once __DIR__ . '/../repository/CardRepository.php';

class SetsController extends AppController
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

    public function sets()
    {
        $sets = $this->setRepository->getAllSetsByUser();
        $this->render('sets', ['sets' => $sets]);
    }

    public function addSet()
    {
        if ($this->isPost()) {
            $set = new Set($_POST['setName'], $_SESSION["userid"]);
            $id_set = $this->setRepository->addSetByUser($set);

            for ($i = 1; $i <= 10; $i++) {
                if ((isset($_POST['q' . $i]) and $_POST['q' . $i] != '') && (isset($_POST['a' . $i]) and $_POST['a' . $i] != '')) {
                    $card = new Card($_POST['q' . $i], $_POST['a' . $i]);
                    $this->addCard($card, $id_set);
                }
            }

            return $this->render('sets', [
                'messages' => $this->message,
                'sets' => $this->setRepository->getAllSetsByUser()
            ]);
        }

        return $this->render('addSet', ['messages' => $this->message]);
    }

    public function addCard($card, $id_set)
    {
        $this->cardRepository->addCardToSet($card, $id_set);
    }

}
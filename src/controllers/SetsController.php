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
        if ($this->isPost() && (isset($_POST['setName']) && $_POST['setName'] != '')) {
            $set = new Set($_POST['setName'], $_SESSION["userid"]);
            $id_set = $this->setRepository->addSetByUser($set);

            for ($i = 0; $i < count($_POST['question']); $i++) {
                if ((isset($_POST['question'][$i]) and $_POST['question'][$i] != '') && (isset($_POST['answer'][$i]) and $_POST['answer'][$i] != '')) {
                    $card = new Card($_POST['question'][$i], ($_POST['answer'][$i]));
                    $this->addCard($card, $id_set);
                }
            }

            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/sets");
            
            return $this->render('sets', [
                'messages' => $this->message,
                'sets' => $this->setRepository->getAllSetsByUser()
            ]);
        }

        return $this->render('addSet', ['messages' => $this->message]);
    }

    public function search()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->setRepository->getSetByTitle($decoded['search']));
        }
    }

    public function addCard($card, $id_set)
    {
        $this->cardRepository->addCardToSet($card, $id_set);
    }

}
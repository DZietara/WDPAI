<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Card.php';

class CardRepository extends Repository
{
    public function addCardToSet(Card $card, string $id_set)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.cards (id_set, question, answer) 
            VALUES (:id_set, :question, :answer)
        ');

        $question = $card->getQuestion();
        $answer = $card->getAnswer();

        $stmt->bindParam(':id_set', $id_set);
        $stmt->bindParam(':question', $question);
        $stmt->bindParam(':answer', $answer);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }

    public function getAllCardsBySetId($id_set): array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users u
            INNER JOIN public.sets s ON u.id = s.id_user
            INNER JOIN public.cards c ON s.id = c.id_set
            WHERE id_set = :id_set
        ');

        $stmt->bindParam(':id_set', $id_set, PDO::PARAM_INT);
        $stmt->execute();

        $allCards = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $cards = [];
        foreach ($allCards as $card) {
            $cards[] = new Card(
                $card['answer'],
                $card['question'],
                $card['id_set'],
                $card["id"]
            );
        }

        return $cards;
    }

}
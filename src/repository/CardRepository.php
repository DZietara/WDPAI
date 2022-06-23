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

    public function getAllCardsBySetId(string $id_set): array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.cards WHERE id_set = :id_set
        ');
        // SELECT s.name, c.question, c.answer FROM public.sets s INNER JOIN public.cards c ON s.id=c.id_set WHERE s.id_user=1;
        $stmt->bindParam(':id_set', $id_set, PDO::PARAM_STR);
        $stmt->execute();

        $allCards = $stmt->fetch(PDO::FETCH_ASSOC);

        $cards = [];
        foreach ($allCards as $card) {
            $cards[] = new User(
                $card['answer'],
                $card['question'],
                $card['id_set'],
                $card["id"]
            );
        }

        return $cards;
    }

}
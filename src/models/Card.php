<?php

class Card {
    private $id;
    private $question;
    private $answer;

    public function __construct(string $question, string $answer, string $id = "")
    {
        $this->question = $question;
        $this->answer = $answer;
        $this->id = $id;
    }

    public function getQuestion(): string
    {
        return $this->question;
    }

    public function setQuestion(string $question)
    {
        $this->question = $question;
    }

    public function getAnswer(): string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer)
    {
        $this->answer = $answer;
    }

    public function getId(): string
    {
        return $this->id;
    }

}
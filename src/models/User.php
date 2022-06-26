<?php

class User
{
    private $id;
    private $email;
    private $name;
    private $surname;
    private $password;

    public function __construct(string $email, string $name, string $surname, string $password, int $id = null)
    {
        $this->email = $email;
        $this->name = $name;
        $this->surname = $surname;
        $this->password = $password;
        $this->id = $id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname)
    {
        $this->surname = $surname;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getId()
    {
        return $this->id;
    }
}

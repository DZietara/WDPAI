<?php

class Set {
    private $id;
    private $id_user;
    private $name;

    public function __construct(string $name, string $id_user, string $id = "")
    {
        $this->name = $name;
        $this->id_user = $id_user;
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getIdUser(): string
    {
        return $this->id_user;
    }

    public function setIdUser(string $id_user)
    {
        $this->id_user = $id_user;
    }

    public function getId(): string
    {
        return $this->id;
    }

}
<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository extends Repository
{

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }

        return new User(
            $user['email'],
            $user['name'],
            $user['surname'],
            $user['password'],
            $user["id"]
        );
    }

    public function getAllUsers(): array
    {
        // view
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM all_users 
        ');
        $stmt->execute();
        $allUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = [];
        foreach ($allUsers as $user) {
            $users[] = new User(
                $user['email'],
                $user['name'],
                $user['surname'],
                $user['password'],
                $user["id"]
            );
        }

        return $users;
    }

    public function addUser(User $user)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.users (name, surname, email, password) 
            VALUES (:name, :surname, :email, :password)
        ');

        $email = $user->getEmail();
        $name = $user->getName();
        $surname = $user->getSurname();
        $password = $user->getPassword();

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }

    public function getUserBySearch(string $searchString)
    {
        $searchString = '%' . strtolower($searchString) . '%';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users WHERE LOWER(email) LIKE :search OR LOWER(name) LIKE :search OR LOWER(surname) LIKE :search
        ');

        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteUserById($id_user)
    {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM public.users WHERE id = :id_user
        ');

        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function existUserByEmail(string $email): bool
    {
        if ($this->getUser($email) != null)
            return true;
        return false;
    }

}

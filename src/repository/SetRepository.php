<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Set.php';

class SetRepository extends Repository
{
    public function addSetByUser(Set $set)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.sets (id_user, name) 
            VALUES (:id_user, :name)
        ');

        $id_user = $set->getIdUser();
        $name = $set->getName();

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->execute();
        $stmt->fetch(PDO::FETCH_ASSOC);

        return $this->getIdOfSetAddedByUser($id_user);
    }

    public function getIdOfSetAddedByUser($id_user)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT max(id) as id FROM public.sets WHERE id_user = :id_user
        ');

        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();
        $id_set = $stmt->fetch(PDO::FETCH_ASSOC);

        return $id_set['id'];
    }

    public function getAllSetsByUser(): array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.sets WHERE id_user = :id_user
        ');

        $id_user = $_SESSION["userid"];
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();

        $allSets = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sets = [];
        foreach ($allSets as $set) {
            $sets[] = new Set(
                $set['name'],
                $set['id_user'],
                $set["id"]
            );
        }

        return $sets;
    }

    public function getSetByTitle(string $searchString)
    {
        $searchString = '%' . strtolower($searchString) . '%';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM sets WHERE LOWER(name) LIKE :search AND id_user = :id_user
        ');

        $id_user = $_SESSION["userid"];
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteSet($id)
    {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM public.sets WHERE id_user = :id_user AND id = :id
        ');

        $id_user = $_SESSION["userid"];
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();
    }
}
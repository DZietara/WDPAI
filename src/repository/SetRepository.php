<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Set.php';

class SetRepository extends Repository
{
    public function addSetByUser(Set $set, string $id_user)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.sets (id_user, name) 
            VALUES (:id_user, :name)
        ');

        $name = $set->getName();

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }

    public function getAllSetsByUser(string $id_user): array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.sets WHERE id_user = :id_user
        ');

        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_STR);
        $stmt->execute();

        $allSets = $stmt->fetch(PDO::FETCH_ASSOC);

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

    public function deleteSetByUser(string $id /* $name? */, string $id_user)
    {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM public.sets WHERE id_user = :id_user AND id = :id
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

}
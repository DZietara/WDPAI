<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Role.php';

class RoleRepository extends Repository
{
    public function addRoleByUserId(string $id)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.users_roles (id_user) 
            VALUES (:id)
        ');

        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }

    public function getRoleByUserId(string $id): Role
    {
        $stmt = $this->database->connect()->prepare('
            SELECT r.name FROM public.roles r 
            INNER JOIN public.users_roles u_r ON u_r.id_role = r.id
            INNER JOIN public.users u ON u_r.id_user = u.id
            WHERE u.id = :id;
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $role = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Role(
            $role['name'],
        );
    }
}

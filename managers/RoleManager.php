<?php
class RoleManager extends AbstractManager {

    public function getAllRoles() : array  
    { 
        $query = $this->db->prepare('SELECT * FROM roles');
        $query->execute();
        $roles = $query->fetchAll(PDO::FETCH_ASSOC);
        $list = [];
      
        foreach($roles as $role)
        {
            $r = new Role($role["id"], $role["role_name"]);
            $list[] = $r;
        }
        return $list;  
    }  

    // Autres méthodes pour créer, mettre à jour et supprimer des rôles...
}


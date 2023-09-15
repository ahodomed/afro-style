<?php

class RoleController extends AbstractController {
    
    private RoleManager $rm;
    
    public function __construct()  
    {  
        $this->rm = new RoleManager();
    }

    public function rolesList() : void  
    {  
        $roles = $this->rm->getAllRoles();  
      
        $this->render("roles", [  
            "roles" => $roles  
        ]);  
    }
        
    public function roleDetails(int $roleId) : void  
    {  
        $role = $this->rm->getRoleById($roleId); 
        $this->render("role", [  
            "role" => $role
        ]);  
    }
    
    public function createRole() : void
    {   
        $this->renderAdmin("create-role");
    }
    
    public function checkCreateRole(array $post) : void
    {   
        $roleName = $this->clean($post["role_name"]);
        
        $role = new Role($roleName);
        $newRole = $this->rm->createRole($role);
        
        header('Location: creer-role');
        exit;
    }
    
    public function editRole(int $roleId) : void
    {
        $editRole = $this->rm->getRoleById($roleId);
        $this->renderAdmin("edit-role", [
            "edit-role" =>$editRole
        ]);
    }
    
    public function checkEditRole(array $post, int $roleId) : void
    {
        $editRole = new Role($this->clean($post["role_name"]));
        $editRole->setId($roleId);
        
        $role = $this->rm->editRole($editRole);
       
        header('Location: /admin-roles');
        exit;
    }
    
    public function deleteRole(int $roleId) : void
    {
        $this->rm->deleteRole($roleId);
        header('Location: /admin-roles');
    }
    
    public function rolesListAdmin() : void  
    {  
        $roles = $this->rm->getAllRoles();
      
        $this->renderAdmin("admin-roles",   
            $roles  
        );  
    }
}


<?php

class UserController extends AbstractController{
    
    
    private UserManager $um;
   
    
     public function __construct()  
    {  
        $this->um = new UserManager();

    }
            /* Pour la route /produits */  
   public function renderAllUsers(){
         
       $users = $this->um->getAllUsers();
         $this->renderAdmin("templates/damin/admin-utilisateurs", [  
            "users" => $users 
        ]);  
   }
   public function deleteUser($id){
         
       $delete= $this->um->deleteUserById($id);
       
       
          header('Location: /afro-expo/templates/admin/admin-utilisateurs'); 
   }
    
}


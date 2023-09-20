<?php

class UserController extends AbstractController{
    
    
    private UserManager $um;
   
    
     public function __construct()  
    {  
        $this->um = new UserManager();

    }
    
    
    
    
    
    
            /* Pour la route /produits */  
   public function AllUsers(){
         
       $users = $this->um->getAllUsers();
         $this->renderAdmin("templates/admin/admin-user", [  
            "users" => $users 
        ]);  
   }
   
   
   
   
   public function deleteUser($id){
         
       $delete= $this->um->deleteUserById($id);
       
       
          header('Location: /afrostyle/templates/admin/admin-user'); 
   }
    
}


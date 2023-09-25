<?php

class UserController extends AbstractController{
    
    
    private UserManager $um;
   
    
     public function __construct()  
    {  
        $this->um = new UserManager();

    }
    
    
    
    
    
    
   public function AllUsers(){
         
       $users = $this->um->getAllUsers();
         $this->renderAdmin("templates/admin/admin-user", [  
            "users" => $users 
        ]);  
   }
   

    
    public function editUser($userId) {
    if (isset($_POST["editUser"])) {
        $username = $this->clean($_POST["username"]);
        $email = $this->clean($_POST["email"]);
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirm-password"];
        $userId = $_POST["user_id"]; // Utilisez le champ user_id pour identifier l'utilisateur à mettre à jour

        // ... Rest of your validation and user update logic ...

        // Redirect to the manage user
        $_SESSION['message'] = "L'utilisateur a bien été modifié";
        header("Location: /admin/users/admin-user");
    } else {
        $user = $this->um->getUserById($userId);
        $this->render("admin/users/edit-user", ["user" => $user]);
    }
}


   
   
   public function deleteUser($id){
         
       $delete= $this->um->deleteUserById($id);
       
       
            header("location: /afrostyle/index.php?route=admin-user");
   }
    
}


<?php 
 
class AuthController extends AbstractController {  
    
    private UserManager $um;
    
    public function __construct()  
    {  
        $this->um = new UserManager();
    }  
    /* Pour la page d'inscription */  
    public function register() : void  
    {  
      $this->render("connexion/register", []); // render la page avec le formulaire d'inscription  
    }  
      
    /* Pour vérifier l'inscription */  
    public function checkRegister() : void  
    {  
        
        if(isset($_POST["form-name"]) && $_POST["form-name"] === "registerForm"){
            // vérifier que le formulaire a été soumis
            
            var_dump($_POST["username"]);
            var_dump($_POST["password"]);
            var_dump($_POST["email"]);

            $error =[];
             if(empty($_POST["username"])) {
                $error[] = "Veuillez saisir votre username";
            }
            if(empty ($_POST["password"])){
                $error[] = "Veuillez saisir votre mot de passe";
            }
                        
             if(empty($_POST["email"])){
                $error[] = "Veuillez saisir votre email";
            }
            
            if($this->um->getUserByEmail($_POST["email"])!==null){
                
                $error[] = "cet adresse mail existe déjà";
            }
            
               
            if($_POST["confirm-password"]!== $_POST["password"]){
                $error[] = "les deux mots de passe ne sont pas identiques";
            }
               


            $username = $this->clean($_POST['username']);
            $email = $this->clean($_POST['email']);   // récupérer les champs du formulaire  
            $password = $this->clean($_POST['password']);
            $role_id = "1"; 
            $password_hash = password_hash($password, PASSWORD_DEFAULT);    // chiffrer le mot de passe    
            if(!$error){
            
            $user = new User($username, $email, $password_hash, $role_id);    // appeler le manager pour créer l'utilisateur en base de données 
            
            
            $this->um->createUser($user);
            
                        var_dump($user);

                $this->render("connexion/login", [

                    "message" => ["Le compte a bien été créé"]

                         ]);        
                         } else {

              $this->render("connexion/register", [ "errors" => $error]);
             
            }
        } else{
/*            var_dump("yooooo");
*/            $this->render("connexion/register", []);
        } 
    
    
    } 
    /* Pour la connexion */  
 public function login(): void 
{
    $errors = [];

    if (isset($_POST["formName"]) && $_POST["formName"] === "loginForm") 
    {
        $email = $this->clean($_POST["email"]);
        $password = $_POST["password"];
        
        // Validation de l'e-mail (vous pouvez utiliser filter_var pour une validation plus poussée)
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Format d'e-mail incorrect";
        } else {
            $user = $this->manager->getUserByEmail($email);

            if ($user !== null) 
            {
                if (password_verify($password, $user->getPassword())) 
                {
                    $_SESSION["user"] = $user->getId();
                    $roleName = $this->manager->getUserRoleName($user->getRoleId());
                    $_SESSION["role"] = $roleName['name'];
                    
                    if ($_SESSION["role"] === "Admin")
                    {
                        header("location:/admin/admin-user");
                    } else {
                        // Rediriger vers la page d'accueil ou afficher un message de confirmation
                        header("location:/homepage"); // Vous devrez ajuster l'URL en fonction de votre structure de site.
                    }
                } 
                else 
                {
                    $errors[] = "Mot de passe incorrect";
                }
            } 
            else 
            {
                $errors[] = "Aucun compte avec cet email";
            }
        }
    } 

    // Si vous avez des erreurs, vous pouvez les retourner à la vue pour affichage.
    $this->render("connexion/login", [
        "errors" => $errors
    ]);
}


    // public function checkLogin($_post) : void  
    // {  
    //   if(isset($_post["formName"])
       
    //   &&isset($_post["email"])&& !empty($_post["email"])
    //   &&isset($_post["password"])&& !empty($_post["password"])
    //   ){ // vérifier que le formulaire a été soumis  
    //         $email = $this->clean($_post['email']);   // récupérer les champs du formulaire  
    //         $password = $this->clean($_post['password']);
    //         $user = $this->um->getUserByEmail($email); // si il existe, vérifier son mot de passe    

    //         if ($user)
    //         {
    //             if(password_verify($password, $user->getPassword())){
    //                 $_SESSION["user"] = $user->getUsername();  // utiliser le manager pour vérifier si un utilisateur avec cet email existe    
    //                 $_SESSION["role"] = $user->getRole();
                    
    //                 if($_SESSION["role"] === "admin"){
    //                      header('Location:/admin/admin-utilisateurs'); // si il est bon, connecter l'admin  
    //                 }
    //                 else{
    //                      header('Location:/admin/admin-utilisateurs'); // reparé, apres la depose du site 
    //                 }
    //             }
    //             else{
    //                  header('Location:/admin/admin-utilisateurs'); // si il n'est pas bon renvoyer sur la page de connexion 
    //             }    
    //         }
    //         else{
    //              header('Location:/admin/admin-utilisateurs '); // si il n'existe pas renvoyer vers la page de connexion
    //         }
            
                    
                      
                  
                
    //   }
    // }
    
    public function logout(){

        session_destroy();


           header('Location:index.php?route=');
    }
}


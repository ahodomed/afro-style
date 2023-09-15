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
            
/*            var_dump($_POST["username"]);
            var_dump($_POST["password"]);
            var_dump($_POST["email"]);*/

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
    public function login():void
    {
        $this->render("connexion/login", []); // redirection sur la page avec le formulaire de connexion  

    }
    public function checkLogin(): void
    {
    $error = [];

        if (isset($_POST["formName"])) 
        {
            $email = $this->clean($_POST['email']); // Récupérer les contenus des champs du formulaire
            $password = $this->clean($_POST['password']);

        if (empty($_POST["email"])) 
        {
            $error[] = "Veuillez saisir votre adresse mail";
        }

        if (empty($_POST["password"])) 
        {
            $error[] = "Veuillez saisir votre mot de passe";
        }

        if (empty($error)) 
        {
            $user = $this->um->getUserByEmail($email);

            if ($user)
            {
                if (password_verify($password, $user->getPassword()))
                {
                    $_SESSION["user"] = $user->getUsername();
                    $_SESSION["role"] = $user->getRole();

                    if ($_SESSION["role"] === "admin")
                    {
                        $this->render("admin/admin-user", [ "errors" => $error]);

                    } else 
                        {
                        $this->render("index",["errors"=>$error]); // Rediriger l'utilisateur vers la page d'accueil après la connexion réussie
                        }
                } /*else {
                    $error[] = "Mot de passe incorrect";
                }*/
            }
        }
    }


}


    
    public function logout(){

        session_destroy();


           header('Location:index.php?route=');
    }
}


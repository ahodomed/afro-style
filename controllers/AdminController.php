<?php 
class  AdminController extends AbstractController {
   
    private ProductManager $pm;
    private CategoryManager $cm;
    private MediaManager $mm;
    private UserManager $um;


    public function __construct() {
        $this->pm = new ProductManager();
        $this->cm = new CategoryManager();
        $this->mm = new MediaManager();
        $this->um = new UserManager();
    }
    
    public function manageProduct() {
        $products = $this->pm->getAllProducts();
        $categories = $this->cm->getAllCategories();
        
        foreach($products as $product)
        {
            $categoryId = $product->getCategoryId();
            $categoryName = $this->cm->getCategoryProductName($categoryId);
            $categoriesNames[] = $categoryName;
        }
        $medias = [];
        foreach ($products as $product)
        {
            $mediaId = $product->getMediaId();
            if($mediaId !== null)
            {
                $media = $this->mm->getMediaNameById($mediaId);
                $medias[] = $media;
            }
        }
        $this->render("admin/products/admin-produits", ["products" => $products, "categoriesNames" => $categoriesNames, "medias" => $medias]);
    }
    
    
    
    
    
    
    
    
    public function manageUser()
    {
        $users = $this->um->getAllUsers();
        $this->render("admin/users/admin-user", ["users" => $users]);

    }
    
    public function editUser($userId)
    {
        if (isset($_POST["edit-form"]) && $_POST["edit-form"] === "edit") 
        {
            $email = $this->clean($_POST["edit-email"]);
            $username = $this->clean($_POST["edit-username"]);
            $password = $_POST["edit-password"];
            $confirmPassword = $_POST["edit-confirm-password"];
            $roleId = $this->clean($_POST["edit-roleId"]);
            
            $errors = [];
    
            if (strlen($email) > 50) {
                $errors[] = "L'email ne doit pas dépasser 50 caractères";
            }
    
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "L'email n'est pas écrit correctement";
            }
    
            if (strlen($username) > 50) {
                $errors[] = "Le prénom ne doit pas dépasser 50 caractères";
            }
    
            if ($password !== $confirmPassword) {
                $errors[] = "Les mots de passe ne correspondent pas";
            }
    
            if (!$errors) {
                
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                
                $user = $this->um->getUserById($_GET["id"]);
                
                $user->setUsername($username);
                $user->setEmail($email);
                $user->setPassword($hashedPassword);
                $user->setRole($roleId);
                
                $this->um->edit($user);
                
                // Redirect to the manage user
                $_SESSION['message'] = "L'utilisateur ". $user->getUsername() ." a bien été modifié";
                header("Location: ?route=admin-user");

            } else {
                 $this->render("admin/user/edit", [
                     "errors" => $errors
                     ]);
            }
            
        } else {
            $user = $this->um->getUserById($userId);
            $this->render("admin/users/edit-user", ["user" => $user]);
        }
    }
    public function deleteUser()
    {
        if(isset($_GET['id']))
        {
            $userId = $_GET['id'];
            $this->um->deleteUserById($userId);
            header("Location: ?route=admin-user");
            
        }
    }


}




    
   


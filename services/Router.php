<?php

class Router {  
    
    private AdminController $ac;
    private ProductController $pc;
    private CategoryController $cc;
    private AuthController $auth; 
    private UserController $uc;
    private RoleController $rc;
    private MediaController $mc;
    private HomeController $hc;
    private ProductManager $pm;
    
    public function __construct()  
    {  
        $this->ac =new AdminController();
        $this->pc = new ProductController();
        $this->cc = new CategoryController();
        $this->auth = new AuthController(); 
        $this->uc = new UserController();
        $this->rc = new RoleController();
        $this->mc = new MediaController();
        $this->hc = new HomeController();
        $this->pm = new ProductManager();
    }

    public function checkRoute()
    {
        if (isset($_GET['route'])) {
           
            
            if ($_GET['route'] === "boutique") {
                 $this->pc->productsList();
            }
          elseif ($_GET['route'] === "create-product") {
                $this->pc->createProduct();
            }            
             elseif ($_GET['route'] === "détail-product") {
                $productId = $_GET['productId']; 
                $this->pc->productDetails($productId);
            }
            
            elseif ($_GET['route'] === "register") {
                $this->auth->checkRegister();
            }
            
            elseif ($_GET['route'] === "login") {
                $this->auth->login();
            }
            
            elseif ($_GET['route'] === "admin-produits") {
                $this->pc->productsList();
            }
            
            // else if (isset($_SESSION["role"]) && $_SESSION["role"] === 2)
            // {
                else if ($_GET['route'] === "admin-user") {
                    $this->uc->AllUsers();
                } else if ($_GET['route'] === 'admin-product')
                {
                    $this->ac->manageProduct();
                } else if ($_GET['route'] === "create-product")
                {
                    $this->pc->createProduct();
                } else if ($_GET['route'] === "edit-product" && $_GET['id'])
                {
                    $this->pc->editProduct($_GET['id']);
                } else if ($_GET['route'] === "delete-product" && $_GET['id'])
                {
                    $this->pc->deleteProduct($_GET['id']);
                }
            // }
            
            
            
            elseif ($_GET['route'] === "apropos") {
                $this->hc->aPropos();
            }
            
            elseif ($_GET['route'] === "category") {
                $this->cc->categoriesList();
            }
            
            // Ajoutez d'autres conditions ici
        } else {
              
                $this->hc->index();
            
        }
    }
}

/*
    public function route() {
        if (isset($_GET['route'])) {
            $route = $_GET['route'];

            if ($route === '') {
                $this->categoryController->categoriesList();
            } 
            elseif ($route === 'categories')
            {
                $this->categoryController->categoriesList();
            } 
            elseif ($route === 'produits')
            {
                $this->productController->productsList();
            }
            elseif ($route === 'creer-categorie') {
                $this->categoryController->createCategoryForm();
            }
            elseif
            ($route === 'check-creer-categorie') 
            {
                $this->categoryController->createCategory($_POST);
            } 
            else
            {
                // Redirection vers une page d'erreur 404 ou traitement de route inconnue
            }
        } else {
            // Redirection vers une page d'erreur 404 ou traitement de route manquante
        }
    }
}*/
?>
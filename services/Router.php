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
        if (isset($_GET['route']))
        {   
            if ($_GET['route'] === "home") {
                 $this->hc->index();
            }
            elseif ($_GET['route'] === "apropos") {
                $this->hc->aPropos();
            }
            elseif ($_GET['route'] === "detail-category" && $_GET['id']) {
                $this->pc->listProductsByCategory($_GET['id']);
            }
            elseif ($_GET['route'] === "boutique") 
            {
                 $this->pc->productsList();
            }
             elseif ($_GET['route'] === "create-product") 
            {
                $this->pc->createProduct();
            }            
             elseif ($_GET['route'] === "detail-product" && $_GET['id'])
            {
                $this->pc->productDetails($_GET['id']);
            }
            
            elseif ($_GET['route'] === "register")
            {
                $this->auth->checkRegister();
            }
            
            elseif ($_GET['route'] === "login") 
            {
                $this->auth->login();
            }
            elseif ($_GET['route'] === "deconnexion")
            {
                $this->auth->deconnexion();
            }
            
            else if (isset($_SESSION["role"]) && $_SESSION["role"] === 2)
            {
             if ($_GET['route'] === "admin-user")
            {
                    $this->ac->manageUser();
            }
            else if ($_GET['route'] === "edit-user" && $_GET["id"])
            {
                    $this->ac->editUser($_GET["id"]);
            }
            else if($_GET['route'] === "delete-user" && $_GET["id"])
            {
                    $this->ac->deleteUser($_GET["id"]);
            }
            else if ($_GET['route'] === 'admin-product')
            {
                    $this->ac->manageProduct();
            }
            else if ($_GET['route'] === "create-product")
            {
                    $this->pc->createProduct();
            }
            else if ($_GET['route'] === "edit-product" && $_GET['id'])
            {
                    $this->pc->editProduct($_GET['id']);
            }
            else if ($_GET['route'] === "delete-product" && $_GET['id'])
            {
                    $this->pc->deleteProduct($_GET['id']);
            } 
                
            }
            elseif ($_GET['route'] === "contact")
            {
                $this->hc->contact();
            }
            else if($_GET['route']=== "mentions-legales")
            {
                $this->hc->mention();
            }
            
         
            elseif ($_GET['route'] === "category") 
            {
                $this->cc->categoriesList();
            }
            
            // Ajoutez d'autres conditions ici
        } else {
              
                $this->hc->index();
            
        }
    }
}


?>
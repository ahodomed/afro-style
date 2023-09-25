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
        $this->renderAdmin("products/admin-produits", ["products" => $products, "categoriesNames" => $categoriesNames, "medias" => $medias]);
    }
    
    
    
    
    
    
    
    
    public function manageUser()
    {
    
        $users = $this->um->getAllUsers();
        $this->renderAdmin("users/admin-user", ["users" => $users]);

    }
    
    public function deleteUser()
    {
        if(isset($_GET['id']))
        {
            $userId = $_GET['id'];
            $this->um->delete($userId);
            $userList = $this->um->getAllUsers();
            
                    if (empty($userList)) {
                        echo json_encode(array("success" => false, "message" => "Aucun Utilisateur disponible."));
                    } else {
                        $Data = array('success' => true, 'message' => 'Utilisateurs supprimé avec succès.', 'users' => $userList);
                        echo json_encode($Data);
                    }
        } else {
                echo json_encode(array("success" => false, "message" => "L'utilisateur n'a pas été supprimé"));
        }
    }


}




    
   
?>

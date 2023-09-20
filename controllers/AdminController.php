<?php 
class  AdminController extends AbstractController {
   
    private ProductManager $pm;
    private CategoryManager $cm;
    private MediaManager $mm;


    public function __construct() {
        $this->pm = new ProductManager();
        $this->cm = new CategoryManager();
        $this->mm = new MediaManager();
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
}
?>

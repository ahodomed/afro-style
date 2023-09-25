<?php

class ProductController extends AbstractController {
    
    private ProductManager $pm;
    private CategoryManager $cm;
    private MediaManager $mm;
    
    public function __construct()  
    {  
        $this->pm = new ProductManager();
        $this->cm = new CategoryManager();
        $this->mm = new MediaManager();
    }
    
    
    
    
    
    public function productsList() : void  
    {  
        $products = $this->pm->getAllProducts();  
      
        $this->render("produit/products", [  
            "products" => $products  
        ]);  
    }
    
    
    
    
    
    public function productDetails(int $productId) : void  
    {  
        $product = $this->pm->getProductById($productId); 
        $categories = $this->cm->getCategoriesByProduct($productId);

        $this->render("produit/product", [
            "product" => $product, 
            "categories" => $categories
        ]);  
    }






    public function createProduct() : void
    {
        if(isset($_POST['createProduct']) && $_POST['createProduct'] === "submit")
        {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $media_url = $_POST['media-url'];
            $media_name = $_POST['media-name'];
            $category_id = $_POST['product-category'];
            
            $media = new Media($media_name, $media_url);
            $this->mm->createMedia($media);
            $media_id = $media->getId();
            
            $newProduct = new Product($name, $description, $price, $media_id, $category_id);
            $this->pm->createProduct($newProduct);
            
            $_SESSION['message'] = "Le produit ". $name ." créé avec succès.";
            header("location: /afrostyle/index.php?route=admin-products");
        }
        
        $categories = $this->cm->getAllCategories();
        $this->render("admin/products/create-product", []);
    }
    
    
    
    
    

public function checkCreateProduct(array $post) : void
{
    try {
        $media = $this->uploadFile($_FILES);
        $post["media"] = $media->getUrl();
        
        $product = $this->createProductObject($post);
        $newprod = $this->pm->createProduct($product);
        
        header('Location: creer-produit');
        exit;
    } catch (Exception $e) {
        echo "Une erreur s'est produite : " . $e->getMessage();
    }
}




/*
private function uploadFile(array $file) : Media
{
    $uploader = new Uploader();
    return $uploader->upload($file, "image");
}

private function createProductObject(array $post) : Product
{
    return new Product(
        $this->clean($post["name"]),
        $this->clean($post["description"]),
        intval($this->clean($post["price"])),
        $post["media"],
        $post["categories"]
    );
}
*/
    
    
    
    
    
    public function editProduct($productId) : void
    {
        if(isset($_POST['editProduct']) && $_POST['editProduct'] === "submit")
        {
            $name = $_POST['product-name'];
            $description = $_POST['product-description'];
            $price = $_POST['product-price'];
            $media_url = $_POST['media_url'];
            $media_name = $_POST['media_name'];
            $category_id = $_POST['product-categoryId'];
            
            $product =$this->pm->getProductById($productId);
            
            if(isset($_POST['productMediaId']))
            {
                $media_id = $_POST['productMediaId'];
                $media = $this->mm->getMediaById($media_id);
                
                $media->setUrl($media_url);
                $media->setName($media_name);
                $this->mm->editMedia($media);
                $editedMedia = $this->mm->getMediaById($media->getId());
                
            } else {
                $media = new Media($media_name, $media_url);
                $this->mm->createMedia($media);
                $media_id = $media->getId();
                $editedMedia = $this->mm->getMediaById($media_id);
            }
            $product->setName($name);
            $product->setDescription($description);
            $product->setPrice($price);
            $product->setMediaId($editedMedia->getId());
            $product->setCategoryId($category_id);
            
            $this->pm->edit($product);
            
            $_SESSION['message'] = "Le produit ". $name ." à été modifié avec succès.";
            header("location: /afrostyle/index.php?route=admin-product");
            
        } else {
            $product = $this->pm->getProductById($productId);
            $mediaId = $product->getMediaId();
            $medias = $this->mm->getMediaById($mediaId);
            $categories = $this->cm->getAllCategories();
            $this->render("admin/products/edit-product", ["product" => $product, "medias" => $medias, "categories" => $categories]);
        }
        
    }
    
    
    
    
    
    public function deleteProduct() : void
    {
        if(isset($_GET['id']))
        {
            $productId = $_GET['id'];
            $product = $this->pm->getProductById($productId);
            $this->pm->delete($productId);
            $_SESSION['message'] = "le produit " .$product->getName(). " à été supprimé";
            header("location: /afrostyle/index.php?route=admin-product");
        }
    }
    
    
    
    
    
    

}

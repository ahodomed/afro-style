<?php

class ProductController extends AbstractController {
    
    private ProductManager $pm;
    private CategoryManager $cm;
    
    public function __construct()  
    {  
        $this->pm = new ProductManager();
        $this->cm = new CategoryManager();
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

        $this->render("product", [
            "product" => $product, 
            "categories" => $categories
        ]);  
    }

    public function createProduct() : void
{   
    $produit = $this->pm->createProduct(); 
    $categories = $this->cm->getAllCategories();

    $this->renderAdmin("produit/create-product", [
        "products" => $produit, 
        "categories" => $categories
    ]);
}






    
    public function checkCreateProduct(array $post) : void
    {   
        // Process form data and create a new product
        // ...

        header('Location: creer-produit');
        exit;
    }
    
    public function editProduct(string $productSlug) : void
    {
        $editProduct = $this->pm->getProductBySlug($productSlug);
        $this->renderAdmin("edit-product", [
            "edit-product" => $editProduct
        ]);
    }
    
    public function checkEditProduct(array $post, string $productSlug) : void
    {
        // Process form data and update the product
        // ...

        header('Location: /Res03ProjetFinalV2/admin-produits');
        exit;
    }
    
    public function deleteProduct(string $productSlug) : void
    {
         $product = $this->pm->deleteProduct($productSlug);
         header('Location: /Res03ProjetFinalV2/admin-produits');
    }
    
    public function productsListAdmin() : void  
    {  
        $products = $this->pm->getAllProducts();
      
        $this->renderAdmin("admin-produits", [  
            "products" => $products  
        ]);  
    }
}

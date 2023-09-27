<?php

class CategoryManager extends AbstractManager {  
   
    public function getAllCategories(): array  
    {  
        $list = [];  
      
        $query = $this->db->prepare('SELECT * FROM categories');
        $query->execute();
        $categories = $query->fetchAll(PDO::FETCH_ASSOC);
       
        foreach($categories as $categorie)
        {
            $categ = new Category($categorie["name"], $categorie["description"]);
            $categ->setId($categorie["id"]);
            $list[] = $categ;
        }
        
        return $list;  
    }  
    
    public function getCategoryProductName($categoryId)
    {
        $query = $this->db->prepare('SELECT name FROM categories WHERE id = :categoryId');
        $parameters = [
                'categoryId' => $categoryId
            ];
        $query->execute($parameters);
        $categoryName = $query->fetch(PDO::FETCH_ASSOC);
        
        return $categoryName;
    }
    
    public function createCategory(Category $category): Category
    {
        $query = $this->db->prepare('INSERT INTO categories VALUES (null, :name, :description)');
        $parameters = [
            'name' => $category->getName(),
            'description' => $category->getDescription()
        ];
        $query->execute($parameters);
        $category->setId($this->db->lastInsertId());
        return $category;
    }
    
    public function editCategory(Category $category): Category
    {
        $query = $this->db->prepare('UPDATE categories SET name = :name, description = :description WHERE id = :id');
        $parameters = [
            'name' => $category->getName(),
            'description' => $category->getDescription(),
            'id' => $category->getId()
        ];
        $query->execute($parameters);
        
        return $category;
    }
    
    public function deleteCategory(int $categoryId): void
    {
        $query = $this->db->prepare('DELETE FROM products_categories WHERE category_id = :id');
        $parameters = [
            'id' => $categoryId
        ];
        $query->execute($parameters);    
        
        $query = $this->db->prepare('DELETE FROM categories WHERE id = :id');
        $query->execute($parameters);    
    }  
    public function getProductsByCategory($categoryId)
    {
        $query = $this->db->prepare('SELECT * FROM products WHERE category_id = :categoryId');
        $parameters = [
            'categoryId' => $categoryId
        ];
        $query->execute($parameters);

        $products = [];
    
        foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $productData) {
            $product = new Product(
                $productData['name'],
                $productData['description'],
                $productData['price'],
                $productData['media_id'],
                $productData['category_id']
            );
            $product->setId($productData['id']);
            $products[] = $product;
        }

        return $products;
    }

    public function getCategoryById(int $categoryId): Category  
    {  
        $query = $this->db->prepare('SELECT * FROM categories WHERE id = :id'); 
        $parameter = ["id" => $categoryId];
        $query->execute($parameter);
        $categoryData = $query->fetch(PDO::FETCH_ASSOC);
        $category = new Category($categoryData["name"], $categoryData["description"]);
        $category->setId($categoryData["id"]);
        return $category;
    }
    
    public function getCategoriesByProductId(int $productId): array
    {
        $query = $this->db->prepare('SELECT categories.* FROM products_categories JOIN products ON products_categories.products_id = products.id JOIN 
                                        categories ON products_categories.category_id = categories.id WHERE products.id = :id');
        $parameter = ["id" => $productId];
        $query->execute($parameter);
        $categories = $query->fetchAll(PDO::FETCH_ASSOC);
        $list = [];
        
        foreach($categories as $categorie)
        {
            $categ = new Category($categorie["name"], $categorie["description"]);
            $categ->setId($categorie["id"]);
            $list[] = $categ;
        }
        
        return $list;
    }
}

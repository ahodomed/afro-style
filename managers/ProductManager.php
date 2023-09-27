<?php

class ProductManager extends AbstractManager {


    // To get all the categories in an array
   public function getAllProducts() :? array     
    {         
        $query=$this->db->prepare("SELECT * FROM products");         
        $query->execute();         
        $products = $query->fetchAll(PDO::FETCH_ASSOC);   
        if($products)
        {
            $productsTab = [];
            foreach($products as $product)
            {
                $productInstance = new Product($product["name"], $product["description"], $product["price"], $product["media_id"], $product["category_id"]);
                $productInstance->setId($product["id"]);
                $productTab[] = $productInstance;
                array_push($productsTab, $productInstance);
            }
            return $productTab;
        }
        else
        {
            return null;
        }     
    }
    
    public function getProductById($productId)
    {
        $query = $this->db->prepare("SELECT * FROM products WHERE id = :productId");
        $parameters = [
                "productId" => $productId
            ];
            
        $query->execute($parameters);
        $productData = $query->fetch(PDO::FETCH_ASSOC);
        $product = new Product($productData['name'], $productData['description'], $productData['price'], $productData['media_id'], $productData['category_id']);
        $product->setId($productData['id']);
        return $product;
    }




    // Create a product and send it in the database
    public function createProduct(Product $product) : Product
    {
        $query = $this->db->prepare("INSERT INTO products (name, description, price, media_id, category_id)
                                VALUES (:name, :description, :price, :media_id, :category_id)");
    
        $parameters = [
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice(),
            'media_id' => $product->getMediaId(),
            'category_id' => $product->getCategoryId()
        ];

        $query->execute($parameters);

        // Vous pouvez maintenant attribuer l'ID à partir de la base de données
        $product->setId($this->db->lastInsertId());

        return $product;
    }





    // If we want to edit a product
    public function edit(Product $product) : void
    {
        $query=$this->db->prepare("UPDATE products SET name = :name, description = :description, price = :price, media_id = :media_id, category_id = :category_id WHERE id = :id");
        $parameters = [
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice(),
            'media_id' => $product->getMediaId(),
            'category_id' => $product->getCategoryId(),
            'id' => $product->getId()
        ];
        $query->execute($parameters);
    }

    // To delete a Product
    public function delete(int $productId) : void
    {
        $query= $this->db->prepare("DELETE FROM products WHERE id = :id");
        $parameters=['id' => $productId];
        $query->execute($parameters);
    }

    // To find a Product by its name
    public function getProductByName(string $name) : Product
    {
        $query=$this->db->prepare("SELECT * FROM products WHERE product_name = :name");
        $parameters=['name' => $name];
        $query->execute($parameters);

        $result=$query->fetch(PDO::FETCH_ASSOC);
        $product = new Product($result['product_name'], $result['pictures'], $result['description'], $result['price'], $result['quantity']);

        return $product;
    }

    // To get all the products from a same category
    public function getProductByCategory(string $name) : array
    {
        $query=$this->db->prepare("SELECT * FROM products JOIN categories ON products.id = categories.product_id
            WHERE categories.name = :name");
        $parameters=['name' => $name];
        $query->execute($parameters);

        $list = $query->fetchAll(PDO::FETCH_ASSOC);

        return $list;
    }
}


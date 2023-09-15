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
                $productInstance = new Product($product["name"], $product["picture"], $product["description"], $product["price"], $product["quantity"]);
                $productInstance->setId($product["id"]);
                $productInstance->setCategoryId($product["category_id"]);
                $productTab[] = $productInstance;
                var_dump($productTab);
                // array_push($productsTab, $productInstance);
            }
            return $productTab;
        }
        else
        {
            return null;
        }     
    }


    // Create a product and send it in the database
    public function createProduct(Product $product) : Product
    {
        $query=$this->db->prepare("INSERT INTO products (product_name, picture, description, price, quantity)
                  VALUES (:name, :picture, :description, :price, :quantity)");
        $parameters = [
            'name' => $product->getName(),
            'picture' => $product->getPicture(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice(),
            'quantity' => $product->getQuantity()
        ];

        $query->execute($parameters);
        $id = $query->fetch(PDO::FETCH_ASSOC);
        $product->setId($this->db->lastInsertId());

        return $product;
    }

    // If we want to edit a product
    public function editProduct(Product $product) : void
    {
        $query=$this->db->prepare("UPDATE products SET product_name = :name, pictures = :picture, description = :description, price = :price, quantity = :quantity");
        $parameters = [
            'name' => $product->getName(),
            'picture' => $product->getPicture(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice(),
            'quantity' => $product->getQuantity()
        ];
        $query->execute($parameters);
    }

    // To find the Product by its id
    public function getProductById(int $id) : Product
    {
        $query=$this->db->prepare("SELECT * FROM products WHERE products.id = :id");
        $parameters=['id' => $id];
        $query->execute($parameters);
        $product = $query->fetch(PDO::FETCH_ASSOC);

        $newProd = new Product($product['product_name'], $product['pictures'], $product['description'], $product['price'], $product['quantity']);

        return $newProd;
    }

    // To delete a Product
    public function deleteProduct(int $id) : void
    {
        $query=$this->db->prepare("DELETE FROM products WHERE products.id = :id");
        $parameters=['id' => $id];
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


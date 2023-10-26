<?php

class Message
{
    private $id;
    private $name;
    private $email;
    private $message;
    private $product_id;

    public function __construct($name, $email, $message, $product_id )
    {
        $this->id = null;
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
        $this->product_id = $product_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getProductId()
    {
        return $this->product_id;
    }

   

    // Méthodes setter pour modifier les attributs
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }

}

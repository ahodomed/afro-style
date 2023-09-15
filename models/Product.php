<?php

class Product {
    private ?int $id;
    private string $name;
    private string $picture;
    private string $description;
    private float $price;
    private int $quantity;
    private ?int $category_id;

    public function __construct(string $name, string $picture, string $description, float $price, int $quantity)
    {
        $this->id = null;
        $this->name = $name;
        $this->picture = $picture;
        $this->description = $description;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->category_id = null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPicture(): string
    {
        return $this->picture;
    }
    public function setPicture(string $picture): void
    {
        $this->picture = $picture;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }


    public function getCategoryId(): ? int
    {
        return $this->category_id;
    }
    public function setCategoryId(int $category_id): void
    {
        $this->category_id = $category_id;
    }
}


?>
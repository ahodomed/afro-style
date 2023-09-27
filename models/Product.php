<?php

class Product {
    private ?int $id;
    private string $name;
    private string $description;
    private float $price;
    private ?int $media_id;
    private ?int $category_id;
    private array $media = [];

    public function __construct(string $name, string $description, float $price, ?int $media_id, ?int $category_id)
    {
        $this->id = null;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->media_id = $media_id;
        $this->category_id = $category_id;
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

    public function getMediaId(): ? int
    {
        return $this->media_id;
    }
    public function setMediaId(string $media_id): void
    {
        $this->media_id = $media_id;
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

    public function getCategoryId(): ? int
    {
        return $this->category_id;
    }
    public function setCategoryId(int $category_id): void
    {
        $this->category_id = $category_id;
    }
    public function getMedia(): array
    {
        return $this->media;
    }
    public function setMedia(array $media): void
    {
        $this->media = $media;
    }
}


?>
<?php


class Role {
    private ?int $id;
    private string $name;

    public function __construct(int $id, string $name) {
        $this->id = $id;
        $this->rolename = $name;
    }

    // Accesseur pour l'ID du rôle
    public function getId() {
        return $this->id;
    }

    // Mutateur pour l'ID du rôle
    public function setId($id) {
        $this->id = $id;
    }

    // Accesseur pour le nom du rôle
    public function getName() {
        return $this->name;
    }

    // Mutateur pour le nom du rôle
    public function setName($name) {
        $this->name = $name;
    }
}

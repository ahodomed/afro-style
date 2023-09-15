<?php

class User {
    private ?int $id;
    private string $username;
    private string $email;
    private string $password;
    private int $role_id;


    public function __construct(string $username,string $email,string $password, int $role_id)
    {
        $this->id = null;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role_id = $role_id;

    }

    //Les accesseurs de l'attribut id

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
       
    
    //Les accesseurs de l'attribut username
    
     public function getUsername(): string
    {
        return $this->username;
    }
    
     public function setUserName(string $username): void
    {
        $this->username = $username;
    }


    //Les accesseurs de l'attribut email
    
     public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    
        //Les accesseurs de l'attribut password
        
    public function getPassword(): string
    {
        return $this->password;
    }
    
     public function setPassword(string $password): void
    {
        $this->password = $password;
    }

   

 //Les accesseurs de l'attribut role_id

     public function getRole(): ?int
    {
        return $this->role_id;
    }
    
        public function setRole(int $role_id): void
    {
        $this->role_id = $role_id;
    }
   
}
?>

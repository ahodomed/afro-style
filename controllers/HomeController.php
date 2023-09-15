<?php
    class HomeController extends AbstractController {
        

    public function __construct()
    {


    }


 public function index()
    {
        
        $this->render('templates/index', []);


    }

     public function aPropos() : void  
    {  
        $this->render("templates/a-propos/apropos", []);  
    }
      




}

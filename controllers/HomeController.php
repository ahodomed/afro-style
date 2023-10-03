<?php
    class HomeController extends AbstractController {
        

    public function __construct()
    {


    }


 public function index()
    {
        $this->render('templates/homepage', []);
    }

     public function aPropos() : void  
    {  
        $this->render("templates/a-propos/apropos", []);  
    }
    
          
     public function contact() : void  
    {  
        $this->render("templates/contact/contact",[]);  
    }
      

 public function home()
    {
        
        $this->render('templates/homepage', []);


    }
    
}

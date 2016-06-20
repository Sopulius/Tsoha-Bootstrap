<?php  

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        
         View::make('home.html');
        
    }
    
    public static function login(){
        View::make('suunnitelmat/login.html');
    }
    
    public static function section_show(){
        View::make('suunnitelmat/section_show.html');
    }
    
    public static function product_show(){
        View::make('suunnitelmat/product_show.html');
    }
    
    public static function product_edit(){
        View::make('suunnitelmat/product_edit.html');
    }
    
    public static function user_products_show(){
        View::make('suunnitelmat/show_user_products.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
     
        $musiikki = Section::find(1);
        $sections = Section::all();
        
        Kint::dump($musiikki);
        Kint::dump($sections);
    }
  }

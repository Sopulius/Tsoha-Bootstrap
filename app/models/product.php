<?php

class Product extends BaseModel{
    public $id, $name, $startPrice, $description;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Product');
        $query->execute();
        
        $rows = $query->fetchAll();
        $products = array();
        
        foreach($rows as $row){
            array_push($products, new Product(array(
                'id'=> $row['id'],
                'name'=>$row['name'],
                'startPrice'=> $row['startPrice'],
                'description'=> $row['description']
            )));
        }
        
        return $products;
    }
    
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Product WHERE id=:id LIMIT 1');
        $query->execute(array('id'=>$id));
        
        $row = $query->fetch();
        
        if($row){
             $product = new Product(array(
                'id'=> $row['id'],
                'name'=>$row['name'],
                'startPrice'=> $row['startprice'],
                'description'=> $row['description']
             ));
             return $product;
        }
        
        return null;
       
    }
   
}


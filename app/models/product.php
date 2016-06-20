<?php

class Product extends BaseModel{
    public $id, $name, $startPrice, $description;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
        $this->validators = array('validate_name','validate_description');
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
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Product(name,description,startprice) VALUES (:name,:description,:startprice) RETURNING id');
        $query->execute(array(
            'name' => $this->name,
            'description'=>$this->description,
            'startprice'=>$this->startPrice));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
     public function validate_name(){
        return $this->validate_string_length($this->name, 1, 50);
    }
    
    public function validate_description(){
        return $this->validate_string_length($this->description, 1, 300);
    }
   
}


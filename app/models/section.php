<?php


class Section extends BaseModel{
    public $id, $name;
    
    public function __construct($attributes){
        parent::__construct($attributes);
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Section');
        $query->execute();
        
        $rows = $query->fetchAll();
        $sections = array();
        
        foreach($rows as $row){
            array_push($sections, new Section(array(
                'id'=> $row['id'],
                'name'=> $row['name']
            )));
        }
        
        return $sections;
    }
    
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Section WHERE id= :id LIMIT 1');
        $query->execute(array('id'=>$id));
        
        $row = $query->fetch();
        
        if($row){
            $section = new Section(array(
                'id'=> $row['id'],
                'name'=> $row['name']
            ));
            
            return $section;
        }
        
        return null;
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Section(name) VALUES (:name) RETURNING id');
        $query->execute(array('name' => $this->name));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
}

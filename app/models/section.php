<?php


class Section extends BaseModel{
    public $id, $name;
    
    public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_name');
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
    
    public function update(){
        $query = DB::connection()->prepare('UPDATE Section SET name = :name WHERE id=:id');
        $query->execute(array('name'=> $this->name, 'id'=> $this->id));
    }
    
    public function destroy(){
        $query = DB::connection()->prepare('DELETE FROM Section WHERE id=:id');
        $query->execute(array('id'=>$this->id));
    }
    
    public function validate_name(){
        return $this->validate_string_length($this->name, 4, 20);
    }
}

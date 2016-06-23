<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Customer extends BaseModel {

    public $id, $name, $password, $iban, $phone, $email, $address;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
        $this->validators = array(
            'validate_name', 
            'validate_password',
            'validate_iban',
            'validate_phone',
            'validate_email',
            'validate_address');
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Customer WHERE id=:id LIMIT 1');
        $query->execute(array('id' => $id));

        $row = $query->fetch();

        if ($row) {
            $customer = new Customer(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password'],
                'phone' => $row['phone'],
                'email' => $row['email'],
                'address' => $row['address'],
                'iban'=>$row['iban']
            ));

            return $customer;
        }

        return null;
    }
    
    public function store(){
        $query = DB::connection()->prepare('INSERT INTO Customer(name, password, iban, phone, email, address) VALUES(:name, :password, :iban, :phone, :email, :address)');
        $query->execute(array(
            'name'=>$this->name,
            'password'=>$this->password,
            'iban'=>$this->iban,
            'phone'=>$this->phone,
            'email'=>$this->email,
            'address'=>$this->address
        ));
    }

    public static function authenticate($name, $password) {
        $query = DB::connection()->prepare('SELECT * FROM Customer WHERE name = :name AND password = :password LIMIT 1');
        $query->execute(array('name' => $name, 'password' => $password));
        $row = $query->fetch();
        if ($row) {
            return new Customer(array(
                'id'=>$row['id'],
                'name'=>$row['name'], 
                'password'=>$row['password'],
                'phone'=> $row['phone'],
                'email'=> $row['email'],
                'address'=>$row['address'],
                'iban'=>$row['iban']
                ));
        } else {
            return null;
        }
    }
    
    public function validate_name(){
        return $this->validate_string_length($this->name, 4, 20, 'Käyttäjätunnus');
    }
    
    public function validate_password(){
        return $this->validate_string_length($this->password, 6, 30, 'Salasana');
    }
    
    public function validate_phone(){
        $errors = array();
        if($this->phone == null){
            $errors[] = 'Kenttä "Puhelinnumero" ei saa olla tyhjä.';
        }
        return $errors;
    }
    
    public function validate_iban(){
        $errors = array();
        if(substr($this->iban, 0, 2) != 'FI' || strlen($this->iban) != 18){
            $errors[]='Tarkista antamasi IBAN.';
        }
        return $errors;
    }
    
    public function validate_email(){
        $errors = array();
        if($this->email == null){
            $errors[] = 'Kenttä "Sähköposti" ei saa olla tyhjä.';
        }
        return $errors;
    }
    
    public function validate_address(){
        $errors = array();
        if($this->address == null){
            $errors[] = 'Kenttä "Osoite" ei saa olla tyhjä.';
        }
        return $errors;
    }
    

}

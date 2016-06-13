<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Customer extends BaseModel {

    public $id, $name, $password, $phone, $email, $address;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
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
                'address' => $row['address']
            ));

            return $customer;
        }

        return null;
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
                'address'=>$row['address']
                ));
        } else {
            return null;
        }
    }

}

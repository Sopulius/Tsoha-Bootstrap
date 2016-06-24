<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserController extends BaseController {

    public static function login() {
        View::make('customer/login.html');
    }

    public static function handle_login() {
        $params = $_POST;

        $user = Customer::authenticate($params['username'], $params['password']);

        if (!$user) {
            View::make('customer/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else {
            $_SESSION['user'] = $user->id;

            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $user->name . '!'));
        }
    }

    public static function logout() {
        $_SESSION['user'] = null;
        Redirect::to('/', array('message' => 'Olet kirjautunut ulos!'));
    }
    
    public static function register(){
        View::make('customer/register.html');
    }
    
    public static function handle_register(){
        $params = $_POST;
        
        $attributes = array(
            'name'=>$params['username'],
            'address'=>$params['address'],
            'password'=>$params['password'],
            'email'=>$params['email'],
            'phone'=>$params['phone'],
            'iban'=>$params['iban']
        );
        
        $user = new Customer($attributes);
        
        $errors = $user->errors();
        if($params['password']!=$params['passwordRe']){
            $errors[]='Antamasi salasanat eivät täsmänneet.';
        }
        
        if($errors){
            View::make('customer/register.html', array(
                'attributes'=>$attributes, 
                'errors'=>$errors
                    ));
        }else{
            $user->store();
            Redirect::to('/',array('message'=>'Rekisteröityminen onnistui!'));
        }
    }
    
    public static function profile(){
        self::check_logged_in();
        $bidAuctions = AuctionListViewModel::allWhereCustomerHasBids($_SESSION['user']);
        $own = AuctionListViewModel::allFromCustomer($_SESSION['user']);
        View::make('customer/profile.html',array('bidded'=>$bidAuctions, 'own'=>$own));
    }

}

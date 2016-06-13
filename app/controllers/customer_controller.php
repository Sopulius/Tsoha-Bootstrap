<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CustomerController extends BaseController{
    public static function login(){
        View::make('customer/login.html');
    }
    
    public static function handle_login(){
        $params = $_POST;
        
        $customer = Customer::authenticate($params['username'], $params['password']);
        
        if(!$customer){
            View::make('customer/login.html', array('error'=>'Väärä käyttäjätunnus tai salasana!', 'username'=>$params['username']));
        }else{
           $_SESSION['customer'] = $customer->id;
           
           Redirect::to('/', array('message'=>'Tervetuloa takaisin ' . $customer->name.'!'));
        }
    }
}
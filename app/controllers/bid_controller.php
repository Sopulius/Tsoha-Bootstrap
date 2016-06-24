<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BidController extends BaseController{
    public static function store($id){
        self::check_logged_in();
        $params = $_POST;
        
        $bid = new Bid(array(
            'auctionId'=>$id,
            'price'=>$params['price'],
            'customerId'=>$_SESSION['user']
        ));
        
        $errors = $bid->errors();
        if($errors){
            Redirect::to('/auction/'.$id, array('errors'=>$errors));
        }
        
        $bid->save();
        
        Redirect::to('/auction/'.$id,
                array('message'=>'Huutosi on lisätty'));
        
        
    }
    
    public static function destroy($id){
        self::check_logged_in();
        $bid = Bid::find($id);
        $bid->destroy();
        Redirect::to('/auction/'.$bid->auctionId, array('message'=>'Huuto poistettu!'));
    }
}
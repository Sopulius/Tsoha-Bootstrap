<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AuctionController extends BaseController{
    public static function displayAuction($id){
        $view = AuctionDisplayViewModel::find($id);
        View::make('auction/display.html',array('view'=>$view));
    }
    
    public static function displayCustomerAuctions($id){
        $view = CustomerViewModel::find($id);
        View::make('auction/customer_auctions.html', array('view'=>$view));
    }
    
    public static function newAuction(){
        self::check_logged_in();
        $sections = Section::all();
        View::make('auction/new.html', array('sections'=>$sections));
    }
    
    
    
    public static function store(){
        $params = $_POST;
        
        $attributes = array(
            'name'=>$params['name'],
            'description'=>$params['description'],
            'startPrice'=>$params['startPrice']);
        
        $product = new Product(array(
            'name'=>$params['name'],
            'description'=>$params['description'],
            'startPrice'=>$params['startPrice']
        ));
        
        $errors = $product->errors();
        
        $days = $params['days'];
        if($days == null){
            $errors[] = 'Anna huutokaupalle kesto.';
        }
        if($errors){
            $sections = Section::all();
             View::make('auction/new.html', array('errors'=>$errors, 'attributes'=>$attributes, 'sections'=>$sections));
        }
        
        $product->save();
        
        $auction = new Auction(array(
            'customerId'=> $_SESSION['user'],
            'sectionId'=>$params['section'],
            'productId'=>$product->id,
            'endDate'=>$params['days']
        ));
        $auction->save();
        
        Redirect::to('/auction/'. $auction->id, 
                array('message'=>'Tuotteesi on listattu!'));
        
        
    }
    
    public static function edit($id){
        $auctionView = AuctionDisplayViewModel::find($id);
        self::check_user_access($auctionView->seller->id);
        View::make('auction/edit.html', array('view'=>$auctionView));
    }
        
        
        
        
    
    
    public static function update($id){
       
        $params = $_POST;
        
        $attributes = array('name'=>$params['name'],
            'startPrice'=>$params['startprice'],
            'description'=>$params['description'],
            'id'=>$id);
        
        $product = new Product($attributes);
        
        $errors = $product->errors();
        
        if($errors){
            $auctionView = AuctionDisplayViewModel::find($id);
            View::make('auction/edit.html', array('view'=>$auctionView, 'errors'=>$errors));
        }else{
            $product->update();
            $auctionView = AuctionDisplayViewModel::find($id);
            Redirect::to('/auction/'.$id, array('view'=>$auctionView, 'message'=>'Kohde päivitetty onnistuneesti!'));
        }
        
        
        
    }
    
    public static function destroy($id){
        self::check_logged_in();
        $auction = Auction::find($id);
        $auction->destroy();
        Redirect::to('/section/'.$auction->sectionId, array('message'=>'Huutokauppa poistettu!'));
    }
}
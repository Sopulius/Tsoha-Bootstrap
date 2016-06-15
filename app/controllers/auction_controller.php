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
    
    public static function newAuction(){
        $sections = Section::all();
        View::make('auction/new.html', array('sections'=>$sections));
    }
    
    public static function store(){
        $params = $_POST;
        
        $product = new Product(array(
            'name'=>$params['name'],
            'description'=>$params['description'],
            'startPrice'=>$params['startPrice']
        ));
        
        $product->save();
        
        $auction = new Auction(array(
            'customerId'=> $_SESSION['customer'],
            'sectionId'=>$params['section'],
            'productId'=>$product->id,
            'endDate'=>$params['days']
        ));
        $auction->save();
        
        Redirect::to('/auction/'. $auction->id, 
                array('message'=>'Tuotteesi on listattu!'));
        
        
    }
}
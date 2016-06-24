<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ConfirmationViewModel extends BaseModel{
    public $seller, $buyer, $auction, $product, $winningBid;
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public static function find($id){
        $auction = Auction::find($id);
        $product = Product::find($auction->productId);
        $winningBid = Bid::findHighestBid($id);
        $buyer = Customer::find($winningBid->customerId);
        $seller = Customer::find($auction->customerId);
        
        $attributes = array(
            'seller'=>$seller,
            'buyer'=>$buyer,
            'auction'=>$auction,
            'product'=>$product,
            'winningBid'=>$winningBid
        );
        
        return new ConfirmationViewModel($attributes);
    }
    
    
}
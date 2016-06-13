<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AuctionDisplayViewModel extends BaseModel{
    public $auction, $product, $seller, $bids;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public static function find($id){
        $auction = Auction::find($id);
        $product = Product::find($auction->productId);
        $seller = Customer::find($auction->customerId);
        $bids = Bid::auctionBidsDesc($auction->id);
        return new AuctionDisplayViewModel(array(
            'auction'=>$auction,
            'product'=>$product,
            'seller'=>$seller,
            'bids'=>$bids
        ));
    }
}
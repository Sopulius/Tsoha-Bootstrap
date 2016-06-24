<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AuctionListViewModel extends BaseModel {

    public $auction, $product, $highestBid;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }

    public static function allInSection($id) {
        $auctions = Auction::allInSection($id);
        return self::create_list_view($auctions);
    }
    
    public static function allFromCustomer($id) {
        $auctions = Auction::allFromCustomer($id);
        return self::create_list_view($auctions);
    }
    
    public static function allOpen(){
        $auctions = Auction::allOpen();
        return self::create_list_view($auctions);
    }
    
    public static function allOpenInSection($id){
        $auctions = Auction::allOpenInSection($id);
        return self::create_list_view($auctions);
    }
    
    public static function allClosed(){
        $auctions = Auction::allClosed();
        return self::create_list_view($auctions);
    }
    
    public static function allWhereCustomerHasBids($id){
        $auctions = Auction::allWhereCustomerHasBids($id);
        return self::create_list_view($auctions);
    }
    
    private static function create_list_view($auctions){
        $listView = array();
        
        if (!empty($auctions)){
             foreach ($auctions as $auc) {
                $prod = Product::find($auc->productId);
                $bid = Bid::findHighestBid($auc->id);
                array_push($listView, 
                     new AuctionListViewModel(array('auction' => $auc,
                    'product' => $prod,
                    'highestBid' => $bid)));
            }
            return $listView;
        }
        return null;
    }

}

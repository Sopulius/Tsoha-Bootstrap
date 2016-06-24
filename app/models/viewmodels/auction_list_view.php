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
        $listView = array();
        $auctions = Auction::allInSection($id);
        if (!empty($auctions)) {
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
    
    public static function allFromCustomer($id) {
        $listView = array();
        $auctions = Auction::allFromCustomer($id);
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
    
    public static function allOpen(){
        $listView = array();
        $auctions = Auction::allOpen();
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
    
    public static function allOpenInSection($id){
        $listView = array();
        $auctions = Auction::allOpenInSection($id);
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
    
    public static function allClosed(){
        $listView = array();
        $auctions = Auction::allClosed();
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

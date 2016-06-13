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
                $bid = Bid::findHighestBid($id);
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

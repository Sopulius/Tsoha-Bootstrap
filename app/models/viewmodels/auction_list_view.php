<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AuctionListView extends BaseModel {

    public $auction, $product, $highestBid;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }

    public static function allInSection($id) {
        $listView = array();
        $auctions = Auction::auctionsInSection($id);
        if (!empty($auctions)) {
            foreach ($auctions as $auc) {
                $prod = Product::find($auc->productId);
                array_push($listView, 
                     new AuctionListView(array('auction' => $auc,
                    'product' => $prod,
                    'highestBid' => null)));
            }
            return $listView;
        }
        return null;
    }

}

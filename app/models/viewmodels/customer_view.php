<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CustomerViewModel extends BaseModel {
     public $customer, $auctionList;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public static function find($id){
        $customer = Customer::find($id);
        $auctions = AuctionListViewModel::allFromCustomer($id);
        return new CustomerViewModel(array('customer'=>$customer,
            'auctionList'=>$auctions));
    }
}
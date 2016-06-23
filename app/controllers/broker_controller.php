<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BrokerController extends BaseController{
    public static function index(){
        View::make('broker/index.html');
    }
    
    public static function open_auctions(){
        $view = AuctionListViewModel::allOpen();
        View::make('broker/open_auctions.html', array('auctionList'=>$view));
    }
    
    public static function closed_auctions(){
        $view = AuctionListViewModel::allClosed();
        View::make('broker/closed_auctions.html', array('auctionList'=>$view));
    }
    
    public static function confirm_auction(){
        
    }
}
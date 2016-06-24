<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SectionViewModel extends BaseModel{
    public $section, $auctionList;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public static function find($id){
        $sec = Section::find($id);
        $auctions = AuctionListViewModel::allOpenInSection($id);
        return new SectionViewModel(array('section'=>$sec,
            'auctionList'=>$auctions));
    }
}
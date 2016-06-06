<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SectionView extends BaseModel{
    public $section, $auctionList;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public static function create($sectionId){
        $sec = Section::find($sectionId);
        $auctions = AuctionListView::allInSection($sectionId);
        return new SectionView(array('section'=>$sec,
            'auctionList'=>$auctions));
    }
}
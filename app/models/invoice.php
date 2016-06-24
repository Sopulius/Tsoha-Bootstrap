<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Invoice extends BaseModel{
    public $id,$auctionId;
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Invoice(auctionid) VALUES(:auctionid)');
        $query->execute(array('auctionid'=>$this->auctionId));
    }
}
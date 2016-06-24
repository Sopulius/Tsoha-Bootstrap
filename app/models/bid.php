<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Bid extends BaseModel {

    public $id, $customerId, $auctionId, $bidDate, $price;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
        $this->validators = array('validate_price', 'validate_customer');
    }
    
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Bid WHERE id =:id LIMIT 1');
        $query->execute(array('id'=>$id));
        $row =$query->fetch();
        if ($row) {
            $bid = new Bid(array(
                'id'=>$row['id'],
                'customerId' => $row['customerid'],
                'auctionId' => $row['auctionid'],
                'price' => $row['price'],
                'bidDate'=>$row['biddate']
            ));
            
            return $bid;
        }
        
        return null;
    }

    public static function findHighestBid($id) {
        $query = DB::connection()->prepare('SELECT * FROM Bid WHERE auctionid = :id ORDER BY price DESC LIMIT 1');
        $query->execute(array('id' => $id));

        $row = $query->fetch();

        if ($row) {
            $bid = new Bid(array(
                'id'=>$row['id'],
                'customerId' => $row['customerid'],
                'auctionId' => $row['auctionid'],
                'price' => $row['price'],
                'bidDate'=>$row['biddate']
            ));
            
            return $bid;
        }
        
        return null;
    }
    
    public static function auctionBidsDesc($id){
        $query = DB::connection()->prepare('SELECT * FROM Bid WHERE auctionid=:id ORDER BY price DESC');
        $query->execute(array('id'=>$id));
        
        $rows = $query->fetchAll();
        if($rows){
            $bids = array();
            foreach($rows as $row){
                array_push($bids, new Bid(array(
                    'id'=>$row['id'],
                    'auctionId'=>$row['auctionid'],
                    'customerId'=>$row['customerid'],
                    'price'=>$row['price'],
                    'bidDate'=>$row['biddate']
                )));
            }
            
            return $bids;
        }
        
        return null;
    }
    
     
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Bid(auctionid, customerid, price) VALUES (:auctionid,:customerid,:price)');
        $query->execute(array(
            'auctionid' => $this->auctionId,
            'customerid'=>$this->customerId,
            'price'=>$this->price));
        $row = $query->fetch();
    }
    
    public function destroy(){
        $query = DB::connection()->prepare('DELETE FROM Bid WHERE id=:id');
        $query->execute(array('id'=>$this->id));
    }
    
    public function validate_price(){
        $errors = array();
        $highest = Bid::findHighestBid($this->auctionId);
        if($highest == null){
            $auction = Auction::find($this->auctionId);
            $product = Product::find($auction->productId);
            if($this->price < $product->startPrice){
                $errors[] = 'Tarjouksesi tulee olla suurempi kuin alkuhinta!';
            }
        }else if($highest->price >= $this->price){
            $errors[] = 'Kohteesta on jo tehty korkeampi huuto!';
        }
        return $errors;
    }
    
    public function validate_customer(){
        $errors = array();
        $highest = Bid::findHighestBid($this->auctionId);
        if($highest){
            if($highest->customerId == $this->customerId){
                $errors[]='Sinulla on jo kohteen korkein tarjous!';
            }
        }
        return $errors;
    }
    
    public function customer_name(){
        $query = DB::connection()->prepare('SELECT Customer.name as name FROM Customer WHERE :id = id LIMIT 1');
        $query->execute(array('id'=>$this->customerId));
        $row = $query->fetch();
        if($row){
            return $row['name'];
        }
        return null;
    }

}

<?php

class Auction extends BaseModel {

    public $id, $sectionId, $customerId, $productId, $startDate, $endDate;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Auction');
        $query->execute();

        $rows = $query->fetchAll();
        $auctions = array();

        foreach ($rows as $row) {
            array_push($auctions, new Auction(array(
                'id' => $row['id'],
                'sectionId'=> $row['sectionid'],
                'customerId' => $row['customerid'],
                'productId' => $row['productid'],
                'startDate' => $row['startdate'],
                'endDate' => $row['enddate']
            )));
        }

        return $auctions;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Auction WHERE id=:id LIMIT 1');
        $query->execute(array('id' => $id));

        $row = $query->fetch();

        if ($row) {
            $auction = new Auction(array(
                'id' => $row['id'],
                'sectionId' => $row['sectionid'],
                'customerId' => $row['customerid'],
                'productId' => $row['productid'],
                'startDate' => $row['startdate'],
                'endDate' => $row['enddate']
            ));

            return $auction;
        }

        return null;
    }

    public static function auctionsInSection($id) {
        $query = DB::connection()->prepare('SELECT * FROM Auction WHERE sectionid= :id');
        $query->execute(array('id' => $id));

        $rows = $query->fetchAll();
        $auctions = array();

        if (!empty($rows)) {
            foreach ($rows as $row) {
                array_push($auctions, new Auction(array(
                    'id' => $row['id'],
                    'sectionId' =>  $row['sectionid'],
                    'customerId' => $row['customerid'],
                    'productId' => $row['productid'],
                    'startDate' => $row['startdate'],
                    'endDate' => $row['enddate']
                )));
            }

            return $auctions;
        }
        
        return null;
    }

}

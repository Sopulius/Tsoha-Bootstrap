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
        return self::handle_rows($rows);
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
    
    public static function allOpen(){
        $query = DB::connection()->prepare('SELECT * FROM Auction WHERE enddate > localtimestamp ORDER BY enddate DESC');
        $query->execute();

        $rows = $query->fetchAll();
        return self::handle_rows($rows);
    }
    
    public static function allOpenInSection($id){
        $query = DB::connection()->prepare('SELECT * FROM Auction WHERE enddate > localtimestamp AND sectionid = :id ORDER BY enddate DESC');
        $query->execute(array('id'=>$id));

        $rows = $query->fetchAll();
        return self::handle_rows($rows);
    }
    
    public static function allClosed(){
        $query = DB::connection()->prepare('SELECT * FROM Auction WHERE enddate < localtimestamp ORDER BY enddate DESC');
        $query->execute();

        $rows = $query->fetchAll();
        return self::handle_rows($rows);
    }
    
    

    public static function allInSection($id) {
        $query = DB::connection()->prepare('SELECT * FROM Auction WHERE sectionid= :id');
        $query->execute(array('id' => $id));

        $rows = $query->fetchAll();
        return self::handle_rows($rows);
    }
    
    
    public static function allFromCustomer($id) {
        $query = DB::connection()->prepare('SELECT * FROM Auction WHERE customerid = :id');
        $query->execute(array('id' => $id));

        $rows = $query->fetchAll();
        return self::handle_rows($rows);
    }
    
    public static function allWhereCustomerHasBids($id){
        $query = DB::connection()->prepare('SELECT DISTINCT Auction.id as id, Auction.sectionid as sectionid, Auction.customerid as customerid, '
                . 'Auction.productid as productid, Auction.startdate as startdate, Auction.enddate as enddate FROM Auction, Bid '
                . 'WHERE Bid.auctionid = Auction.id AND Bid.customerid = :id');
        $query->execute(array('id'=>$id));
        $rows = $query->fetchAll();
        return self::handle_rows($rows);
    }
    
    public function save(){
        $query = DB::connection()->prepare("INSERT INTO Auction(enddate,customerid,productid,sectionid) VALUES (localtimestamp(1) + interval ' 24 hours' * :enddate ,:customerid, :productid, :sectionid) RETURNING id");
        $query->execute(array(
            'enddate'=>$this->endDate,
            'customerid'=>$this->customerId,
            'productid'=>$this->productId,
            'sectionid'=>$this->sectionId));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    public function destroy(){
        $query = DB::connection()->prepare('DELETE FROM Auction WHERE id=:id');
        $query->execute(array('id'=>$this->id));
    }
    
    private static function handle_rows($rows){
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
    
    public function is_handled(){
        $query = DB::connection()->prepare("SELECT * FROM Invoice WHERE auctionid = :id LIMIT 1");
        $query->execute(array('id'=>$this->id));
        $row = $query->fetch();
        if($row){
            return true;
        }
        return false;
    }
    
    public function is_closed(){
        $query = DB::connection()->prepare("SELECT * FROM Auction WHERE localtimestamp > :enddate AND id = :id LIMIT 1");
        $query->execute(array('enddate'=>$this->endDate, 'id'=>$this->id));
        $row = $query->fetch();
        if($row){
            return true;
        }
        return false;
    }

}

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
    
    public static function confirm_auction($id){
        
        $view = ConfirmationViewModel::find($id);
        
        $subject = 'Huutokaupan vahvistus';
        
        
        
        $toBuyer = $view->buyer->email;
        
        
        $messageBuyer = "Olette voittaneet kohteen ".$view->product->name."\r\n".
                    "Myyjän ilmoittama IBAN on: ".$view->seller->iban."\r\n".
                    "Maksettava summa: ".$view->winningBid->price."€\r\n".
                    "Olkaa hyvä ja maksakaa huutamanne tuote sekä ilmoittakaa postitusosoitteenne myyjälle."."\r\n".
                    "Myyjän sähköpostiosoite: ".$view->seller->email;
        
        $messageSeller = "Kohteenne sulkeutuminen on vahvistettu. Odottakaa että ostaja on maksanut".
                "\r\n"." ja antanut teille postitusosoitteen."."\r\n".
                "Tarvittaessa voitte ottaa yhteyttä ostajan sähköpostiin: ".$view->buyer->email;
        
        $headers = array("From: template@template.com",
            "Reply-To: template@template.com",
            "X-Mailer: PHP/".PHP_VERSION);
        $headers = implode("\r\n", $headers);
        //mail($toBuyer, $subject, $messageBuyer, $headers);
        //mail($toSeller,$subject, $messageSeller, $headers);
        
        $invoice = new Invoice(array('auctionId'=>$id));
        $invoice->save();
        
        Redirect::to("/broker/closed", array('message'=>'Huutokauppa vahvistettu!'));
    }
}
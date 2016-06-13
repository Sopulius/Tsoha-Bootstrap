<?php

  //Etusivu
  $routes->get('/', function() {
    HelloWorldController::index();
  });
  
  //Osastot
  $routes->post('/section', function(){
      SectionController::store();
  });
  
  $routes->get('/section', function(){
      SectionController::index();
  });
  
  $routes->get('/section/new', function(){
      SectionController::newSection();
  });
  
  $routes->get('/section/:id', function($id){
      SectionController::displaySection($id);
  });
  
  //Huutokaupat
  $routes->post('/auction', function(){
      AuctionController::store();
  });
  
  $routes->get('/auction/new', function(){
      AuctionController::newAuction();
  });
  
  $routes->get('/auction/:id', function($id){
      AuctionController::displayAuction($id);
  });
  
  //suunnitelmat

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/kayttajat/Pekka', function() {
    HelloWorldController::user_products_show();
  });
  
  $routes->get('/login', function() {
   HelloWorldController::login();
           
  });
  
  $routes->get('/osastot/musiikki', function() {
   HelloWorldController::section_show();
           
  });
   
  $routes->get('/osastot/musiikki/1', function() {
   HelloWorldController::product_show();        
  });
  
    
  $routes->get('/osastot/musiikki/1/edit', function() {
   HelloWorldController::product_edit();       
  });

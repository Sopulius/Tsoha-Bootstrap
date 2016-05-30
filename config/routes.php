<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

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

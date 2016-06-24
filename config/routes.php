<?php

//Etusivu
$routes->get('/', function() {
    IndexController::index();
});
//Pääsy evätty
$routes->get('/forbidden', function(){
    AccessController::denied();
});

//Meklari
$routes->get('/broker', function(){
    BrokerController::index();
});

$routes->get('/broker/open', function(){
    BrokerController::open_auctions();
});

$routes->get('/broker/closed', function(){
    BrokerController::closed_auctions();
});

$routes->post('/broker/confirm/:id', function($id){
    BrokerController::confirm_auction($id); 
});

//Käyttäjät
$routes->get('/login', function() {
    
    UserController::login();
});
$routes->post('/login', function() {
    
    UserController::handle_login();
});

$routes->post('/logout', function(){
    UserController::logout();
});

$routes->get('/register', function(){
    UserController::register();
});

$routes->post('/register', function(){
    UserController::handle_register();
});

//Osastot
$routes->post('/section', function() {
    SectionController::store();
});

$routes->get('/section', function() {
    SectionController::index();
});

$routes->get('/section/new', function() {
    SectionController::newSection();
});

$routes->get('/section/:id', function($id) {
    SectionController::displaySection($id);
});

$routes->get('/section/:id/edit', function($id) {
    SectionController::edit($id);
});

$routes->post('/section/:id/edit', function($id) {
    SectionController::update($id);
});

$routes->post('/section/:id/destroy', function($id) {
    SectionController::destroy($id);
});
//Huutokaupat
$routes->post('/auction', function() {
    AuctionController::store();
});

$routes->get('/auction/new', function() {
    AuctionController::newAuction();
});

$routes->get('/auction/:id', function($id) {
    AuctionController::displayAuction($id);
});

$routes->post('/auction/destroy/:id', function($id){
    AuctionController::destroy($id);
});

$routes->get('/auction/:id/edit', function($id){
    AuctionController::edit($id);
});

$routes->post('/auction/:id/edit', function($id){
    AuctionController::update($id);
});



$routes->get('/auction/customer/:id', function($id){
    AuctionController::displayCustomerAuctions($id);
});

//huudot
$routes->post('/auction/:id/bid', function($id){
    BidController::store($id);
});

$routes->post('/bid/:id/destroy', function($id){
    BidController::destroy($id);
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

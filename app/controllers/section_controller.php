<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class SectionController extends BaseController{
    public static function index(){
        $sections = Section::all();
        View::make('section/index.html', array('sections'=>$sections));
    }
    
    public static function displaySection($id){
       $view = SectionViewModel::find($id);
       View::make('section/display.html', array('view'=>$view));
    }
    
    public static function create(){
        View::make('section/new.html');
    }
    
    public static function store(){
        $params = $_POST;
        
        $section = new Section(array(
            'name'=> $params['name']
        ));
        
        $section->save();
        
        Redirect::to('/section/'.$section->id, array('message' => 'Uusi osasto lisätty!'));
    }
}

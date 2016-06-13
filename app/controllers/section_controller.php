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
    
    public static function newSection(){
        View::make('section/new.html');
    }
    
    public static function edit($id){
        $section = Section::find($id);
        View::make('section/edit.html', array('attributes'=>$section));
    }
    
    public static function store(){
        $params = $_POST;
        
        $section = new Section(array(
            'name'=> $params['name']
        ));
        $errors = $section->errors();
        
        if(count($errors)==0){
            $section->save();
            Redirect::to('/section/'.$section->id, array('message' => 'Uusi osasto lisätty!'));
        }else{
            View::make('section/new.html', array('errors'=>$errors));
        }
        
        
        
        
    }
    
    public static function update($id){
        $params = $_POST;
        
        $attributes = array(
            'id'=>$id,
            'name'=>$params['name']
        );
        
        $section = new Section($attributes);
        $errors = $section->errors();
        
        if(count($errors)==0){
            $section->update();
        
            Redirect::to('/section/' .$id, array('message' => 'Osasto päivitetty!'));
            
        }else{
            View::make('section/edit.html', array('errors'=>$errors, 'attributes'=>$attributes));
        }
        
        
    }
    
    public static function destroy($id){
        $section = new Section(array('id'=>$id));
        $section->destroy();
        Redirect::to('/section', array('message'=>'Osasto poistettu'));
    }
}

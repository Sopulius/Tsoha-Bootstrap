<?php

class BaseController {

    public static function get_user_logged_in() {

        // Katsotaan onko user-avain sessiossa
        if (isset($_SESSION['user'])) {
            $user_id = $_SESSION['user'];
            $user = Customer::find($user_id);

            return $user;
        }

        // Käyttäjä ei ole kirjautunut sisään
        return null;
    }

   public static function check_logged_in(){
    if(!isset($_SESSION['user'])){
      Redirect::to('/login', array('message' => 'Kirjaudu ensin sisään!'));
    }
   }
    
    public static function check_user_access($id) {
        if($_SESSION['user'] != $id && $_SESSION['user'] != 1){
            Redirect::to('/forbidden');
        }
  }

}

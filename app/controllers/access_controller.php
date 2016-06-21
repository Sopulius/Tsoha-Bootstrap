<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of access_controller
 *
 * @author alsu
 */
class AccessController extends BaseController {
    public static function denied(){
        View::make('forbidden.html');
    }
}

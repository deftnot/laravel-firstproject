<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of imagenes
 *
 * @author Jesus
 */
class Imagen extends Eloquent {

    protected $table = 'imagenes';
    
     public function perfiles(){
        return $this->hasMany('perfil');
    }
    
}

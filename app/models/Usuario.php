<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author Jesus
 */
class Usuario extends Eloquent{
    
    protected $table='usuarios';
    protected $guarded=['id','password'];
    
    public function imagenes(){
        return $this->hasMany('imagenes');
    }
    
     public function perfiles(){
        return $this->hasMany('perfil');
    }
    
}

?>

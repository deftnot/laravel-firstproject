<?php
class Estado extends Eloquent{
    
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'estado';
        
        public function ciudades() {
        return $this->hasMany('Ciudad');
    }
    
    
}


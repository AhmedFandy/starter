<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table       = "countries";
    protected $fillable    = ['name' ]; 
    public    $timestamp   = false; 


    public function doctors(){
        return $this->hasManyThrough('App\Models\Doctor' , 'App\Models\Hospital' , 'country_id' ,'hospital_id' , 'id' , 'id' );
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $table= "hospitals";
    protected $fillable    = ['name' ,'address' ,'country_id' , 'created_at', 'updated_at' ] ;
    protected $hidden      = ['created_at' , 'updated_at'];   // لاخفاء 2 عمود 
    public    $timestamp   = true;  // it be true at default


    public function doctors(){
        return $this->hasMany('App\Models\Doctor' , 'hospital_id' , 'id');
    }
}

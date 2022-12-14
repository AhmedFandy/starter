<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table= "services";
    protected $fillable    = ['name' ,'created_at', 'updated_at' ] ;
    protected $hidden      = ['created_at' , 'updated_at' , 'pivot'];   // لاخفاء 2 عمود 
    public    $timestamp   = true;  // it be true at default


    public function hospital(){
        return $this->belongsTo('App\Models\Hospital' , 'hospital_id' , 'id');
    }

    public function doctors(){
        return $this->belongsToMany('App\Models\Doctor' , 'doctor_service' ,  'service_id' ,'doctor_id' , 'id' , 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table= "offers";
    protected $fillable = ['name_ar' ,'name_en' ,'photo', 'price' , 'details_ar' ,'details_en', 'created_at' , 'updated_at' , 'status'] ;
    protected $hidden   = ['created_at' , 'updated_at'];   // لاخفاء 2 عمود 
}

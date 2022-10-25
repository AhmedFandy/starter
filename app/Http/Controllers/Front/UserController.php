<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    public function getIndex(){

        $data=[];
        $data['id'] = 5;
        $data['name'] = 'Ahmed Fandy';


        $obj = new \stdClass();
        $obj -> name   = 'Ahmed Fandy';
        $obj -> id     = 5;
        $obj -> gender = 'male';
        
        return view('welcome' ,compact('data' , 'obj')); 
        // return view('welcome' ,$data); 

    }
}

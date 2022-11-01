<?php

namespace App\Http\Controllers\Front;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class CrudController extends Controller
{
    public function getoffers(){
        return Offer::get();
    }

    public function store(){
        Offer::create([
            'name'    => "offer3",
            'price'   => "5000",
            'details' => 'offer details'
        ]);
    }
}

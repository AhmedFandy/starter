<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class RelationController extends Controller
{
    public function hasOneRelation(){
        $user = User::with('phone')->find(5);
        return response()-> json($user);
    }
}

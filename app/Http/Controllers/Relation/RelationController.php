<?php

namespace App\Http\Controllers\Relation;
use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\Phone;
use App\User;
use Illuminate\Http\Request;

class RelationController extends Controller
{
    public function hasOneRelation(){
        $user = User::with(['phone'=> function($q){
            $q->select('code' ,'phone' , 'user_id');
        } ])->find(5);
       // $user = User::find(5);
        return $user->phone;
       // return response()-> json($user);
    }

    public function hasOneRelationReverse(){
        //$phone = Phone::find(1); // get phone

       // $phone = Phone::with('user')->find(1);// get phone and user of this phone

        $phone = Phone::with(['user' => function($q){
            $q->select('id' , 'name');
        }])->find(1);                         // get phone and user of this phone and user name and user id
        //$phone->makeVisible(['user_id']); // اظهار القيمه اللى معملها اخفاء فى ال موديل داخل الداله دى فقط
      //  $phone->makeHidden(['code']);     // اخفاء القيمه اللى فى ال موديل داخل الداله دى فقط
      // return $phone->user;
        return $phone;
    }

    public function getUserHasPhone(){
        $user = User::whereHas('phone')->get(); // get user has phone
        return $user;
    }
    
    public function getUserNotHasPhone(){
       return User::whereDoesntHave('phone')->get(); // get user has phone
       
    }
    

    public function getUserHasPhoneWithCondition(){
        $user = User::whereHas('phone' , function($q){
            $q->where('code' , 05);
        })->get(); // get user has phone with code 05
        return $user;
    }

   ////////////////One to Many Relation  Methods /////////////////
    public function getHospitalDoctors(){
        $hospital = Hospital::find(1);
      //  dd( $hospital);
        return $hospital ->doctors;
     }

    
}

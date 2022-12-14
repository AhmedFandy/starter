<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Phone;
use App\Models\Service;
use App\User;
use Dotenv\Regex\Success;
use Illuminate\Http\Request;

class RelationController1 extends Controller
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
        $hospital = Hospital::with('doctors')->find(1);
        //return $hospital ->doctors; // return hospital doctors
        //return $hospital; // return hospital and doctors 
        // $doctors =  $hospital ->doctors;
        // foreach($doctors as $doctor){
        //     echo $doctor->name.'<br>';
        //     echo $doctor->title.'<br>';
        // }
        
        $doctor = Doctor::find(5);
        echo $doctor->name."<br>";
        echo $doctor->title."<br>";
        echo  $doctor->hospital->name;
     }


     public function hospitals(){
        $hospitals = Hospital::select('id' , 'name', 'address' )->get();
        return view('doctors.hospitals' , compact('hospitals'));
     }

     public function doctors($hospital_id){
       $hospital = Hospital::find($hospital_id);
       $doctors  = $hospital->doctors;
       return view('doctors.doctors' , compact('doctors'));

     }

     /////Return Hospitals That Have Doctor ////////
     public function hospitalsHasDoctors(){
        $hospitals = Hospital::whereHas('doctors')->get();
        return $hospitals;
     }


     /////Return Hospitals That Have Doctor Male Only And Doctors ////////
     public function hospitalsHasOnlyMaleDoctors(){
        $hospitals = Hospital::with('doctors')->whereHas('doctors' , function($q){
            $q->where('gender' , 1);
        })->get(); 

        return $hospitals;
    }

    public function hospitalsNotHasDoctors(){
        return Hospital::whereDoesntHave('doctors')->get();
    }


    public function deleteHospitals($hospital_id){
        $hospital = Hospital::find($hospital_id);
        if(!$hospital)
        {
            return abort(404);
        }
        ////Delete Doctors in this Hospitals
        $hospital->doctors()->delete();
        $hospital->delete(); // Delete Hospitals
        return redirect()->route('hospitals.all');
    }

    public function getDoctorsServices(){
        $doctor = Doctor::with('services')->find(1);
        return $doctor->name;
       // return $doctor->services;
    }

    public function getServicesDoctors(){
       return $doctor= Service::with(['doctors' =>function($q){
        $q->select('doctors.id' , 'name' , 'title');
       }])->find(1);
    }
 
    public function getDoctorsServicesById($doctor_id){
        $doctor   = Doctor::find($doctor_id);
        $services = $doctor->services;
        $doctors  = Doctor::select('id' , 'name')->get();
        $allservices = Service::select('id' , 'name')->get();
        return view('doctors.services' , compact('services' ,'doctors' , 'allservices'));
    }


    public function saveServicesToDoctors(Request $request){
        $doctor = Doctor::find($request->doctor_id);
        if(!$doctor)
          return abort(404);
        //$doctor->services()->attach($request->services_id);  // many to many insert in database 
       // $doctor->services()->sync($request->services_id);  // many to many insert in database with remove the old value
        $doctor->services()->syncWithoutDetaching($request->services_id);  // many to many insert in database without remove the old value


        return 'Success';
    }
   

}

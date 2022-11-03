<?php

namespace App\Http\Controllers\Front;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{
    public function getoffers(){
        return Offer::get();
    }

    public function store(Request $request){
        $rules= [
            'name'    => 'required|max:100|unique:offers,name',
            'price'   => 'required|numeric',
            'details' => 'required'
        ];

        $messages = [
            'name.required'=>__('messages.offer name required'),
            'price.required'=>'السعر مطلوب',
            'price.numeric'=>'السعر يجب ان يكون رقم',
            'details.required'=>'هذا الحقل مطلوب'
        ];

        $validator = Validator::make($request->all(),$rules,$messages );
        if($validator->fails()){
            
            return redirect()->back()->withErrors( $validator)->withInput($request->all());

        }
        Offer::create([
            'name'    => $request->name,
            'price'   => $request->price,
            'details' => $request->details
        ]);
        return redirect()->back()->with(['success'=>'تم اضافه العرض بنجاح']);
    }

    public function create(){
        return view('offers.create');
    }
}

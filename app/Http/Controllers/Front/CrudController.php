<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use LaravelLocalization;

class CrudController extends Controller
{
     use OfferTrait;

    public function getoffers(){
        return Offer::get();
    }


    public function getAllOffers(){
        $offers = Offer::select('id' , 
        'photo',
        'name_'. LaravelLocalization::getCurrentLocale() . ' as name'  ,
        'price' , 
        'details_'. LaravelLocalization::getCurrentLocale() . ' as details'
        )->get();
        //dd($offer);
        return view('offers.all' , compact('offers'));
    }

    public function store(OfferRequest $request){
        // $rules= [
        //     'name'    => 'required|max:100|unique:offers,name',
        //     'price'   => 'required|numeric',
        //     'details' => 'required'
        // ];

        // $messages = [
        //     'name.required' =>__('messages.offer name required'),
        //     'price.required'=>__('messages.price is required'),
        //     'price.numeric'=>'السعر يجب ان يكون رقم',
        //     'details.required'=>'هذا الحقل مطلوب'
        // ];

        // $validator = Validator::make($request->all(),$rules,$messages );
        // if($validator->fails()){
            
        //     return redirect()->back()->withErrors( $validator)->withInput($request->all());

        // }

        

        // save photo in folder

        //تم نقل عمليه حفظ الصوره فى ملف ""تريد" لكى يتم استخدامها فى اكثر من "كلاس " 

        // $file_extenstion = $request-> photo->getClientOriginalExtension();
        // $file_name       = time().'.'.$file_extenstion;
        // $path            = 'images/offers';                                 
        // $request->photo->move($path , $file_name);


        $file_name = $this->saveImage($request->photo, "images/offers");
        




        Offer::create([
            'photo'      => $file_name,
            'name_ar'    => $request->name_ar,
            'name_en'    => $request->name_en,
            'price'      => $request->price,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en

        ]);
        return redirect()->back()->with(['success' => __('messages.Offer added sucssefully')]);
    }

    public function create(){
        return view('offers.create');
    }


    public function editOffer($offer_id){

        $offer = Offer::find($offer_id);
        if(!$offer){
            return redirect()->back();
        }

        $offer = Offer::select('id','name_ar' , 'name_en' , 'price' , 'details_ar' , 'details_en')->find($offer_id);
    
    //  dd($offer);
        return view('offers.edit' , compact('offer'));
    }


    public function delete($offer_id){
        $offer = Offer::find($offer_id);
        if(!$offer){
            return redirect()->back()->with(['error' => __('messages.Offer not exist')]);
        }
        $offer->delete();
        return redirect()->route('offers.all' )->with(['success' => __('messages.Offer Deleted successfully')]);
    }



    public function updateOffer(OfferRequest $request ,$offer_id){
        //dd($offer_id);

        $offer = Offer::find($offer_id);
        if(!$offer){
            return redirect()->back();
        }

        $offer->update($request->all());  // تعديل كل القيم 

        // $offer->update([
        //     'name_ar' => $request->name_ar,
        //     'name_en' => $request->name_en,  // تعديل قيم محدد
        //     'price'   => $request->price
        // ]);


        return redirect()->back()->with(['success' => 'تم التعديل بنجاح']);


    }



    public function getVideo(){
        return view('vedio');
    }


    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use LaravelLocalization;


class OfferController extends Controller
{
    use OfferTrait;

    public function create(){
       return view('ajaxoffers.create');
    }

    public function store(OfferRequest $request){
       $file_name = $this->saveImage($request->photo, "images/offers");
        
         $offer =Offer::create([
            'photo'      => $file_name,
            'name_ar'    => $request->name_ar,
            'name_en'    => $request->name_en,
            'price'      => $request->price,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en

        ]);

        if($offer){
            return response()->json([
                'status' => true,
                'msg'   => 'تم حفظ البيانات بنجاح'
            ]);
        }
        else{
            return response()->json([
                'status' => false,
                'msg'   => 'فشل حفظ البيانات بنجاح'
            ]);
        }
    }


    public function all(){
        $offers = Offer::select('id' , 
        'photo',
        'name_'. LaravelLocalization::getCurrentLocale() . ' as name'  ,
        'price' , 
        'details_'. LaravelLocalization::getCurrentLocale() . ' as details'
        )->limit(10)->get();
        //dd($offer);
        return view('ajaxoffers.all' , compact('offers'));
    }

    public function delete(Request $request){
        $offer = Offer::find($request->id);
        if(!$offer){
            return redirect()->back()->with(['error' => __('messages.Offer not exist')]);
        }

        $offer->delete();

        return response()->json([
                'status' => true,
                'msg'    => 'تم الحذف بنجاح',
                'id'     => $request->id
            ]);
        
    }

    public function edit(Request $request){

        $offer = Offer::find($request->offer_id);
        if(!$offer){
            return response()->json([
                'status' => false,
                'msg'  =>'هذا العرض غير موجود'
            ]);
        }

        $offer = Offer::select('id','name_ar' , 'name_en' , 'price' , 'details_ar' , 'details_en')->find($request->offer_id);
    
    //  dd($offer);
        return view('ajaxoffers.edit' , compact('offer'));
    }

    public function update(Request $request){
        $offer = Offer::find($request->id);
        if(!$offer){
            return response()->json([
                'status' => false,
                'msg'  =>'هذا العرض غير موجود'
            ]);
        }

        $offer->update($request->all());  // تعديل كل القيم 


        return response()->json([
            'status' => true,
            'msg'   => 'تم تعديل البيانات بنجاح'
        ]);
    }


}

<?php

namespace App\Traits;


Trait OfferTrait
{
     function saveImage($photo , $folder){

        $file_extenstion =  $photo->getClientOriginalExtension();
        $file_name       = time().'.'.$file_extenstion;  //اسم الصوره + الامتداد مثل jpg png
        $path            = $folder;                      // الملف اللى ححتحفظ فيه الصوره
        $photo->move($path , $file_name);                // نقل الصوره للملف
        return $file_name;
    }
}

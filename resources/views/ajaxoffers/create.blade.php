
@extends('layouts.app')

@section('content')

    <div class="alert alert-success" id="success_msg" style="display: none">
     تم الحفظ بنجاح
    </div>
    
      <div class="container">
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    {{__('messages.Add Your Offer')}}
                </div>

                <form method="POST" id="OfferForm" action="" enctype="multipart/form-data"> 
                    @csrf

                    <div class="form-group">
                      <label for="exampleInputEmail1">{{__('messages.Chosse photo')}}</label>
                      <input type="file" class="form-control" name='photo' >
                      <small id="photo_error" class="form-text text-muted text-danger" ></small>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">{{__('messages.Offer Name ar')}}</label>
                      <input type="text" class="form-control" name="name_ar" placeholder="Offer Name">
                      <small id="name_ar_error" class="form-text text-muted text-danger" ></small>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">{{__('messages.Offer Name en')}}</label>
                      <input type="text" class="form-control" name="name_en" placeholder="Offer Name">
                      <small id="name_en_error" class="form-text text-muted text-danger"></small>
                      @enderror
                    </div>


                    <div class="form-group">
                      <label for="exampleInputPassword1">{{__('messages.Enter Price')}}</label>
                      <input type="number" class="form-control" name="price" placeholder="Offer Details">
                      <small id="price_error" class="form-text text-muted text-danger"></small>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.Offer Details ar')}}</label>
                        <input type="text" class="form-control" name="details_ar" placeholder="Offer Details">
                        <small id="details_ar_error" class="form-text text-muted text-danger"></small>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">{{__('messages.Offer Details en')}}</label>
                      <input type="text" class="form-control" name="details_en" placeholder="Offer Details">
                      <small id="details_en_error" class="form-text text-muted text-danger"></small>
                  </div>

                    <button  id="save_offer" class="btn btn-primary">{{__('messages.Save Offer')}}</button>
                  </form>


            </div>
        </div>
      </div>
@stop

@section('scripts')

<script>
  $(document).on('click' , '#save_offer' ,function(e){
    e.preventDefault();
    $('#photo_error').text(''); ///make reset to value
    $('#name_ar_error').text('');
    $('#name_en_error').text('');
    $('#price_error').text('');
    $('#details_ar_error').text('');
    $('#details_en_error').text('');





    var formdata = new FormData($('#OfferForm')[0]);  //content of form in variable

    $.ajax({
    type        : 'post' ,
    enctype     : 'multipart/form-data',
    url         :  "{{route('ajax.offers.store')}}" ,
    // data    :  {
    //   '_token'     : "{{csrf_token()}}",
    //   'name_ar'    : $("input[name = 'name_ar']").val(),
    //   'name_en'    : $("input[name = 'name_en']").val(),
    //   'price'      : $("input[name = 'price']").val(),
    //   'details_ar' : $("input[name = 'details_ar']").val(),
    //   'details_en' : $("input[name = 'details_en']").val(),

    // } ,
    data        : formdata ,
    proceeeData : false,
    contentType : false,
    cache       : false,
    success     : function(data){

      if(data.status == true){
        $('#success_msg').show();
      }

    } , error: function(reject){
      var response = $.parseJSON(reject.responseText);
      $.each(response.errors , function(key , val)){
        $("#" + key + "_error").text(val[0]);
      }
     }
   });
  });

</script>
    
@stop



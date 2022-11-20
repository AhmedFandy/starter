
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
                      @error('photo')
                      <small class="form-text text-muted text-danger" >{{$message}}</small>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">{{__('messages.Offer Name ar')}}</label>
                      <input type="text" class="form-control" name="name_ar" placeholder="Offer Name">
                      @error('name_ar')
                      <small id="emailHelp" class="form-text text-muted text-danger" >{{$message}}</small>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">{{__('messages.Offer Name en')}}</label>
                      <input type="text" class="form-control" name="name_en" placeholder="Offer Name">
                      @error('name_en')
                      <small id="emailHelp" class="form-text text-muted text-danger" >{{$message}}</small>
                      @enderror
                    </div>


                    <div class="form-group">
                      <label for="exampleInputPassword1">{{__('messages.Enter Price')}}</label>
                      <input type="number" class="form-control" name="price" placeholder="Offer Details">
                      @error('price')
                      <small id="emailHelp" class="form-text text-muted text-danger">{{$message}}</small>
                      @enderror
                    </div>


                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.Offer Details ar')}}</label>
                        <input type="text" class="form-control" name="details_ar" placeholder="Offer Details">
                        @error('details_ar')
                        <small id="emailHelp" class="form-text text-muted text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">{{__('messages.Offer Details en')}}</label>
                      <input type="text" class="form-control" name="details_en" placeholder="Offer Details">
                      @error('details_en')
                      <small id="emailHelp" class="form-text text-muted text-danger">{{$message}}</small>
                      @enderror
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

    }
   });
  });

</script>
    
@stop



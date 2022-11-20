@extends('layouts.app')

@section('content')

<div class="alert alert-success" id="success_msg" style="display: none">
  تم الحذف  بنجاح
 </div>
 

<body>
  <nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Link</a>
            </li>
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <li class="nav-item">
              <a class="nav-link" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }}</a>
            </li>
            @endforeach  
             {{-- بتلف على عدد اللفات اللى فى موقع و تحط اللينكات فى المنيو
        --}}
            
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
          
            <li class="nav-item">
              <a class="nav-link disabled">Disabled</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
 

  @if(Session::has('success'))
      <div class="alert alert-success">
        {{Session::get('success')}}
      </div>
  @endif

  @if (Session::has('error'))
  <div class="alert alert-danger">
    {{Session::get('error')}}
  </div>
  @endif


  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">{{__('messages.Offer Name')}}</th>
        <th scope="col">{{__('messages.Offer Price')}}</th>
        <th scope="col">{{__('messages.Offer Details')}}</th>
        <th scope="col">{{__('messages.Offer Photo')}}</th>
        <th scope="col">{{__('messages.Operation')}}</th>

      </tr>
    </thead>
    <tbody>
      @foreach ($offers as $offer)
      <tr class="offerRow{{$offer->id}}">
        <td>{{$offer->id}}</td>
        <td>{{$offer->name}}</td>
        <td>{{$offer->price}}</td>
        <td>{{$offer->details}}</td>
        <td><img style="width:100px ; height:100px;" src="{{asset('images/offers/'.$offer->photo)}}"> </td>
        <td><a href="{{route('offers.edit' , $offer ->id)}}" class="btn btn-success">{{__('messages.update')}}</a>
            <a href="{{route('offers.delete' , $offer ->id)}}" class="btn btn-danger">{{__('messages.Delete')}}</a>
            <a href="" offer_id = {{$offer->id}}  class="delete_btn  btn btn-danger">Delete with ajax</a>
            <a href="{{route('ajax.offers.edit' , $offer ->id)}}" class="btn btn-success">Update with ajax</a>


        </td>
        
      </tr>
      @endforeach

    </tbody>
  </table>
</body>

@stop

@section('scripts')
    
<script>
  $(document).on('click' , '.delete_btn' ,function(e){
    e.preventDefault();

   var offer_id = $(this).attr('offer_id'); //=$('.delete_btn').attr('offer_id');
   
    $.ajax({
    type        : 'post' ,
    enctype     : 'multipart/form-data',
    url         :  "{{route('ajax.offers.delete')}}" ,
    data    :  {
      '_token'  : "{{csrf_token()}}",
      'id'      : offer_id


    } ,
    proceeeData : false,
    contentType : false,
    cache       : false,
    success     : function(data){

      if(data.status == true){
        $('#success_msg').show();
      }
      $('.offerRow' + data.id).remove();

    } , error: function(reject){

    }
   });
  });

</script>
    
@stop
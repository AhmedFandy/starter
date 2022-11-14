
@extends('layouts.app')

@section('content')
    
      <div class="container">
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    {{__('messages.Add Your Offer')}}
                </div>

                <form method="POST" action="{{route('offers.store')}}" enctype="multipart/form-data"> 
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

                    <button type="submit" class="btn btn-primary">{{__('messages.Save Offer')}}</button>
                  </form>


            </div>
        </div>
      </div>
@stop



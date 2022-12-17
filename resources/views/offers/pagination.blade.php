<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
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
                {{-- <form class="d-flex" role="search">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </form> --}}
              </div>
            </div>
          </nav>
        {{-- <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif --}}
        
        

            {{-- <div class="content">
                <div class="title m-b-md">
                    {{__('messages.Add Your Offer')}}
                </div>

                <form method="POST" action="{{route('offers.store')}}"> 
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{__('messages.Offer Name')}}</label>
                      <input type="text" class="form-control" name="name" placeholder="Offer Name">
                      @error('name')
                      <small id="emailHelp" class="form-text text-muted text-danger" >{{$message}}</small>
                      @enderror
                    </div>


                    <div class="form-group">
                      <label for="exampleInputPassword1">Enter Price</label>
                      <input type="number" class="form-control" name="price" placeholder="Offer Details">
                      @error('price')
                      <small id="emailHelp" class="form-text text-muted text-danger">{{$message}}</small>
                      @enderror
                    </div>


                    <div class="form-group">
                        <label for="exampleInputPassword1">Offer Details</label>
                        <input type="text" class="form-control" name="details" placeholder="Offer Details">
                        @error('details')
                        <small id="emailHelp" class="form-text text-muted text-danger">{{$message}}</small>
                        @enderror
                    </div>


                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-primary">{{__('messages.Save Offer')}}</button>
                  </form>


            </div>
        </div> --}}

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
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$offer->name}}</td>
              <td>{{$offer->price}}</td>
              <td>{{$offer->details}}</td>
              <td><img style="width:100px ; height:100px;" src="{{asset('images/offers/'.$offer->photo)}}"> </td>
              <td><a href="{{route('offers.edit' , $offer ->id)}}" class="btn btn-success">{{__('messages.update')}}</a>
                  <a href="{{route('offers.delete' , $offer ->id)}}" class="btn btn-danger">{{__('messages.Delete')}}</a>
              </td>
              
            </tr>
            @endforeach

          </tbody>
        </table>
        <div class="d-flex justify-content-center">
          {!! $offers->links()  !!} 
        </div>
    </body>
</html>

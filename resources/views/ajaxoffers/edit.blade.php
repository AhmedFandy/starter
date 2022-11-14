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
        <div class="flex-center position-ref full-height">
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
            @endif

            <div class="content">
                <div class="title m-b-md">
                    {{__('messages.Update Offer')}}
                </div>

                {{-- <form method="post" action="{{route('offers.update', $offer ->id)}}">  --}}
                {{-- <form method="POST" action="#">  --}}
                  <form method="post" action="{{route('offers.update', $offer->id)}}" enctype="multipart/form-data">
                    @csrf
                    {{-- @method('PUT') --}}
                   
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{__('messages.Offer Name ar')}}</label>
                      <input type="text" class="form-control" name="name_ar" value="{{$offer->name_ar}}" placeholder="Offer Name">
                      @error('name_ar')
                      <small id="emailHelp" class="form-text text-muted text-danger" >{{$message}}</small>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">{{__('messages.Offer Name en')}}</label>
                      <input type="text" class="form-control" name="name_en" value="{{$offer->name_en}}" placeholder="Offer Name">
                      @error('name_en')
                      <small id="emailHelp" class="form-text text-muted text-danger" >{{$message}}</small>
                      @enderror
                    </div>


                    <div class="form-group">
                      <label for="exampleInputPassword1">{{__('messages.Enter Price')}}</label>
                      <input type="number" class="form-control" name="price" value="{{$offer->price}}" placeholder="Offer Details">
                      @error('price')
                      <small id="emailHelp" class="form-text text-muted text-danger">{{$message}}</small>
                      @enderror
                    </div>


                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.Offer Details ar')}}</label>
                        <input type="text" class="form-control" name="details_ar" value="{{$offer->details_ar}}" placeholder="Offer Details">
                        @error('details_ar')
                        <small id="emailHelp" class="form-text text-muted text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">{{__('messages.Offer Details en')}}</label>
                      <input type="text" class="form-control" name="details_en" value="{{$offer->details_en}}" placeholder="Offer Details">
                      @error('details_en')
                      <small id="emailHelp" class="form-text text-muted text-danger">{{$message}}</small>
                      @enderror
                  </div>


                    {{-- <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div> --}}
                    <button type="submit" class="btn btn-primary">{{__('messages.Update Offer')}}</button>
                  </form>


            </div>
        </div>
    </body>
</html>

@extends('layouts.template')

@section('content')
<form action="{{ route('login.auth') }}" class="card p-5" method="post" style="box-shadow: 2px 4px 2px 1px rgba(0, 0, 0, 0.1); margin: 140px 70px 70px 70px;">
        @csrf
        @if(Session::get('failed'))
            <div class="alert alert-danger">{{ Session::get('failed') }}</div>
        @endif
        @if(Session::get('logout'))
            <div class="alert alert-primary">{{ Session::get('logout') }}</div>
        @endif
        @if(Session::get('canAccess'))
            <div class="alert alert-danger">{{ Session::get('canAccess') }}</div>
        @endif
        <div class="container d-flex">
            <div class="image">
                <img src="https://img.freepik.com/free-vector/man-working-computer-home_1308-102130.jpg?w=1380&t=st=1703473790~exp=1703474390~hmac=9c5ab7454075385faa311322061648473f5e2105022bd88575ffd1041dd26f7c" alt="" style="witdh: 250px; height: 250px">
            </div>
            <div class="content" style="margin-left: 200px; width: 1200px; text-align: center">
                <i class="fa fa-house">
                    <h1>Login</h1>
                    <p>Isi Email dan Password dengan teliti</p>
                </i>
                <div class="input-group flex-nowrap" style="margin-bottom: 20px;">
                    <span class="input-group-text" id="addon-wrapping"><img src="https://cdn-icons-png.flaticon.com/128/456/456212.png" alt="" style="witdh: 20px; height: 20px;"></span>
                    <input type="email" class="form-control" placeholder="Email" aria-label="email " aria-describedby="addon-wrapping" style="margin-right: 20px;" name="email">
                </div>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping"><img src="https://cdn-icons-png.flaticon.com/128/63/63432.png" alt="" style="witdh: 20px; height: 20px;"></span>
                    <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="addon-wrapping" style="margin-right: 20px;" name="password">
                </div>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="d-grid gap-2" Style="padding: 30px 20px 30px 0px; text-align: center;"'>
                <button class="btn btn-primary"type="submit" name="submit">LOGIN</button>
                </div>
            </div>
        </div>
    </form>    
@endsection

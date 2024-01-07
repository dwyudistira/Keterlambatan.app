@extends('layouts.template')

@section('content')

    <style>
        .card {
            width: 600px;
            height: 140px;
            margin: 10px;
            padding: 20px;
            box-sizing: border-box;
            font-size: 16px;
            border-radius: 10px;
            box-shadow: 2px 4px 2px 1px rgba(0, 0, 0, 0.1);
        }
        .card-container {
            margin-top: 130px;
            margin-left: 30px;
            display: flex;
            flex-wrap: wrap;
        }
    </style>
  @if(Session::get('alreadyAccess'))
      <div class="alert alert-primary" style="margin-top: 90px;">{{ Session::get('alreadyAccess') }}</div>
  @endif  
<div class="card-container">
    <div class="card">
      <p>Peserta Didik</p>
      <h1><i class="fa fa-user" style="color: blue;"></i> {{ App\Models\Students::count() }}</h1>
    </div>
    <div class="card" style="width: 290px;">
      <p>Administrator</p>
      <h1><i class="fa fa-user" style="color: blue;"></i> {{ App\Models\Users::where('role', '=' , 'admin')->count() }}</h1>
    </div>
    <div class="card" style="width: 290px;">
      <p>Pembimbing siswa</p>
      <h1><i class="fa fa-user" style="color: blue;"></i> {{ App\Models\Users::where('role', '=' , 'ps')->count() }} </h1>
    </div>
    <div class="card">
      <p>Rombel</p>
      <h1><i class="fa fa-bookmark" style="color: blue;"></i> {{ App\Models\Rombels::count() }} </h1>
    </div>
    <div class="card">
      <p>Rayon</p>
      <h1><i class="fa fa-bookmark" style="color: blue;"></i> {{ App\Models\Rayons::count() }} </h1>
    </div>
</div>

@endsection
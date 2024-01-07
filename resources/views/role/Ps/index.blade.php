<!-- resources/views/role/ps/index.blade.php -->

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
        margin-top: 70px;
        display: flex;
        flex-wrap: wrap;
    }
</style>

@if(Session::get('alreadyAccess'))
    <div class="alert alert-primary" style="margin-top: 90px;">{{ Session::get('alreadyAccess') }}</div>
@endif
<div class="card-container">
    <div class="card">
        <p>Rayon: {{ $studentWithRayon['rayon'] }}</p>
        <h1><i class="fa fa-user" style="color: blue;"></i> {{ $studentWithRayon['total_students'] }}</h1>
    </div>
    <div class="card" style=" width : 600px; height: 170px;">
        <p>keterlambatan {{ $studentWithRayon['rayon'] }} Hari ini 
            <br>
        {{ $studentWithRayon['day_and_date_today'] }}</p>
        <p></p>
        <h1><i class="fa fa-user" style="color: blue;"></i> {{ $countLateToday }} </h1>
    </div>
</div>

@endsection

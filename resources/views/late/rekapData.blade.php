@extends('layouts.template')

@section('content')
<div class="container">
    <div class="jumbroton py-5 px-1">
        <h5>{{$student->name}} | {{$student->nis}} | {{$student->rombel->rombel}} | {{$student->rayon->rayon}} </h5>
    </div>
    <div class="row">
        @php $no = 1; @endphp
        @foreach ($lates as $item)
        <div class="card m-3 shadow p-1 mb-5 border-0" style="width: 20rem; height:15rem;">
            <div class="card-body">
                <h4 class="card-title">Keterlambatan ke-{{ $no++ }}</h4>
                <div class="detail ">
                    <b><p class="card-subtitle text-body-secondary mt-3">{{ $item['date_time_late'] }}</p></b>
                    <p class="card-text" style="color: blue;">{{ $item['information'] }}</p>
                    <img src="{{ Storage::url('public/bukti_keterlambatan/' . $item->bukti) }}" alt="">
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection

<style>
    .row img {
        width: 150px;
        height: 90px;
        display: flex;
        border-bottom-left-radius: var(--bs-card-inner-border-radius);
        border-bottom-right-radius: var(--bs-card-inner-border-radius);
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
</style>
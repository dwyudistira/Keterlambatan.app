@extends('layouts.template')

@section('content')


<div class="container mt-3">
    <div class="d-flex justify-content-end" >
        
        </div>
        <div class="card" style="
    margin-top: 70px; 
    padding: 20px;
    box-shadow: 2px 4px 2px 1px rgba(0, 0, 0, 0.1);
    ">
        @if(Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if(Session::get('deleted'))
        <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
        @endif
    <div class="d-flex">
        <div class="p-2">
          <a href="{{ route('late.create')}}" class="btn btn-primary">Tambah</a>
          <a href="{{ route('late.export.excel.lates') }}" class="btn btn-info " style="color: white;" >Export Data Keterlambatan</a>
        </div>
    </div>
      <table class="table ">
        <thead>
          <tr>
            <ul class="nav nav-tabs" style="margin-top: 10px">
                <li class="nav-item">
                  <a class="nav-link  " aria-current="page" href="{{ route('late.home') }}" >Keseluruhan Data</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="{{ route('late.data') }}">Rekapitulasi Data </a>
                </li>
            </ul> 
          </tr>
          <nav class="navbar navbar-expand-lg ">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <div class="card" style=" margin-top: 10px" >
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 12px;">
                  10
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </div>
            </div>
            <form action="{{ route('late.search') }}" method="GET" class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search" style="margin: 10px 10px 0 57rem ">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
          </nav>
          <table class="table ">
            <tr>
                <th>No</th>
                <th>Nis</th>
                <th>Nama</th>
                <th>Jumlah Keterlambatan</th>
                <th class="text-center"></th>
            </tr>
        </thead>
        <!-- ... (kode sebelumnya) ... -->
        <tbody>
            @php
                $no = 0;
                $uniqueNames = [];
                $countNames = collect($lates)
                    ->groupBy('student.name')
                    ->map->count();
            @endphp

            @foreach ($lates as $late)
                @if (!in_array($late->student->name, $uniqueNames))
                    @php $uniqueNames[] = $late->student->name; @endphp

                    <tr>
                        <th scope="row">{{ ++$no  }}</th>
                        <td>{{ $late->student->nis}}</td>
                        <td>{{ $late->student->name }}</td>
                        <td>{{ $countNames[$late->student->name]  }}</td>
                        <td>
                          <form action="{{ route('late.print', $late->id) }}" method="get">
                          <button type="button" class="btn"><a href="{{ route('late.rekap', $late->student_id) }}" style="text-decoration: none; color: black;">Lihat</a></button>
                            @if ($countNames[$late->student->name] >= 3)
                                    @csrf
                                    <button type="submit" class="btn btn-primary"><a href="{{ route('late.print', $late->id) }}" style="color: white; text-decoration: none;">Cetak Surat Pernyataan</a></button>
                                </form>
                            @else
                                <!-- Tidak mencapai 3 keterlambatan, tidak menampilkan tombol -->
                            @endif
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>

        <!-- ... (kode setelahnya) ... -->

        </table>
    </div>
</div>
@endsection
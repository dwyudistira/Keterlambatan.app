@extends('layouts.template')

@section('content')


<div class="card" style="
padding: 20px;
margin-top: 140px;
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
        <a href="{{ route('user.create')}}" class="btn btn-primary" style="margin: 00px;">Tambah</a>
    </div>
</div>
<nav class="navbar navbar-expand-lg ">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <div class="card" style=" margin-top: 10px" >
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 10px;">
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
            <form class="d-flex" role="search" action="{{ route('user.search') }}" method="get">
              <input class="form-control d-flex" style="margin: 0px 10px 0 57rem " type="search" placeholder="Search" aria-label="Search" name="search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </nav>
<table class="table" style="margin-top: 20px">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach ($users as $item)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $item['name'] }}</td>
            <td>{{ $item['email'] }}</td>
            <td>{{ $item['role'] }}</td>
            <td class="d-flex justify-content-center">
                <a href="{{ route('user.edit', $item['id'] )}}" class="btn btn-primary me-3">Edit</a>
                <form action="{{ route('user.delete', $item['id']) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                  </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection
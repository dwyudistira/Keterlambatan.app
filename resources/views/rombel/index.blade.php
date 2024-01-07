@extends('layouts.template')

@section('content')


<div class="card" style="
    padding: 20px;
    margin-top: 140px;
    box-shadow: 2px 4px 2px 1px rgba(0, 0, 0, 0.1);
">
    <div class="d-flex">
        <div class="p-2">
            <a href="{{ route('rombel.create')}}" class="btn btn-primary">Tambah</a>
        </div>
    </div>
    @if(Session::get('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if(Session::get('deleted'))
    <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
    @endif
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
            <form action="{{ route('rombel.search') }}" method="GET" class="form-inline my-2 my-lg-0 d-flex">
              <input class="form-control " type="search" placeholder="Search" aria-label="Search" name="search" >
              <button class="btn btn-outline-success m" type="submit">Search</button>
          </form>
        </nav>
    <table class="table ">
        <thead>
            <tr>
                <th>No</th>
                <th>Rombel</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($rombels as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item['rombel'] }}</td>
                <td class="d-flex justify-content-center">
                    <a href="{{ route('rombel.edit', $item['id'] )}}" class="btn btn-primary me-3">Edit</a>
                    <form action="{{ route('rombel.delete', $item['id']) }}" method="post">
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
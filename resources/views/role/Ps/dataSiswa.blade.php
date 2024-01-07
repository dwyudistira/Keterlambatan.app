@extends('layouts.template')

@section('content')

<div class="card" style="padding: 20px; margin-top: 140px; box-shadow: 2px 4px 2px 1px rgba(0, 0, 0, 0.1);">
    <div class="d-flex">
        <!-- ... -->
    </div>

    @if(Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    @if(Session::get('deleted'))
        <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
    @endif

    <!-- ... -->

    <table class="table">
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
            <form action="{{ route('Ps.role.search') }}" method="GET" class="form-inline my-2 my-lg-0 d-flex">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search" style="margin: 10px 10px 0 57rem ">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </nav>
        <thead>
            <tr>
                <th>No</th>
                <th>Nis</th>
                <th>Nama</th>
                <th>Rombel</th>
                <th>Rayon</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->nis }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->rombel->rombel }}</td>
                    <td>{{ $student->rayon->rayon }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

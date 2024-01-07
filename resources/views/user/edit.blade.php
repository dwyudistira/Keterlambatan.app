@extends('layouts.template')

@section('content')
    <form action="{{ route('user.update', $users['id']) }}" method="POST" class="card p-5" style="margin-top: 90px">
        @csrf
        @method('PATCH')

        @if ($errors->any())
            <ul class="alert alert-danger p-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
            @endforeach
            </ul>
        @endif


        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ $users['name'] }}">
            </div>
            <label for="email" class="col-sm-2 col-form-label">Email :</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" value="{{ $users['email'] }}">
            </div>
            <label for="role" class="col-sm-2 col-form-label">Tipe Pengguna:</label>
            <div class="col-sm-10">
                <select name="role" id="role" class="form-select">
                  <option selected disabled hidden>Pilih</option>
                  <option value="admin">Admin</option>
                  <option value="ps">Pembimbing Siswa</option>
                </select>
              </div>
            <label for="password" class="col-sm-2 col-form-label">Password :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="password" name="password" value="">
            </div>
        </div>
    <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
</form>
@endsection
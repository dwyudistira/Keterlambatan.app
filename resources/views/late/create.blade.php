@extends('layouts.template')

@section('content')
<form action="{{ route('late.store') }}" method="post" class="card p-5" style="margin: 100px;" enctype="multipart/form-data">
    @csrf

    @if (Session::get('success'))
      <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if ($errors->any())
      <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
    @endif
    <div class="mb-3 row">
      <label for="student" class="col-sm-2 col-form-label" name="name">Nama Siswa :</label>
      <div class="col-sm-10">
        <!-- Input untuk memilih data siswa -->
        <select name="student_id" id="id" class="form-select">
          <option selected disabled hidden>Pilih Siswa</option>
          @foreach(\App\Models\Students::all() as $student)
            <option value="{{ $student->id }}">{{ $student->name }}</option>
          @endforeach
          <!-- Tambahkan opsi untuk semua siswa yang relevan -->
        </select>
      </div>
    </div>
    <div class="mb-3 row">
      <label for="datetime" class="col-sm-2 col-form-label">Tanggal Keterlambatan :</label>
      <div class="col-sm-10">
        <!-- Input untuk tanggal keterlambatan -->
        <input type="datetime-local" class="form-control" id="date_time_late" name="date_time_late">
      </div>
    </div>
    <div class="mb-3 row">
      <label for="description" class="col-sm-2 col-form-label">Keterangan Keterlambatan :</label>
      <div class="col-sm-10">
        <!-- Input untuk keterangan keterlambatan -->
        <textarea class="form-control" id="information" name="information" rows="3"></textarea>
      </div>
    </div>
    <div class="mb-3 row">
      <label for="photo" class="col-sm-2 col-form-label">Unggah Bukti (Foto) :</label>
      <div class="col-sm-10">
        <!-- Input untuk mengunggah foto -->
        <input type="file" class="form-control" id="bukti" name="bukti">
      </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
  </form>
@endsection

@extends('layouts.main')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>Tambah Pasien</h1>
     </div>
     <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Widgets</li>
        </ol>
    </div>
  </div>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <form action="/patients/store" method="POST">
                @csrf
                @method('POST')

                @if(session('success'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: 'Pasien Berhasil Ditambhakan!',
                            html: "ID Pasien: {{ session('success')['id'] }}<br>Nama: {{ session('success')['name'] }}<br>Umur: {{ session('success')['age'] }}",
                            icon: 'success',
                         confirmButtonText: 'Ok'
                         });
                     });    
                    </script>
                @endif
                @if ($errors->any())
                <script>
                        document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: 'Pasien Gagal Ditambahkan!',
                            html: "{!! implode('<br>', $errors->all()) !!}", // Menggabungkan semua pesan kesalahan dengan <br>
                            icon: 'error',
                            confirmButtonText: 'Ok'
                            });
                        });
                </script>
                @endif

                <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label" for="name">Nama</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="gender">Jenis Kelamin</label>
                        <input class="form-control" type="text" name="gender" id="gender" value="{{ old('gender') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="address">Alamat</label>
                        <input class="form-control" type="text" name="address" id="address" value="{{ old('address') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="age">Umur</label>
                        <input class="form-control" type="text" name="age" id="age" value="{{ old('age') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="birthday">Tanggal Lahir</label>
                        <input class="form-control" type="text" name="birthday" id="birthday" value="{{ old('birthday') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="phone_number">No. Hp</label>
                        <input class="form-control" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}">
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <a href="/patients" class="btn btn-sm btn-outline-secondary mr-2">Batal</a>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@extends('layouts.main')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>Pasien</h1>
     </div>
  </div>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header d-flex justify-content-end">
                    <a href="/patients/add" class="btn btn-sm btn-primary">
                        Tambah Pasien
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                             <th>No</th>
                             <th>Nama</th>
                             <th>Jenis Kelamin</th>
                             <th>Alamat</th>
                             <th>Umur</th>
                             <th>Tanggal Lahir</th>
                             <th>Nomer HP</th>
                             <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $patient)
                            <tr>
                                <td>{{ $patient->id }}</td>
                                <td>{{ $patient->name }}<tdh>
                                <td>{{ $patient->gender }}</td>
                                <td>{{ $patient->address }}</td>
                                <td>{{ $patient->age }}</td>
                                <td>{{ $patient->birthday }}</td>
                                <td>{{ $patient->phone_number }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="/patients/edit/{{ $patient->id }}" class="btn btn-sm btn-warning mr-2">Edit</a>
                                        <form id="delete-form-{{ $patient->id }}" action="/api/patients/{{ $patient->id }}" method="POST" style="display: none;">
                                            <script>
                                                function confirmDelete(patientId) {
                                                    Swal.fire({
                                                        title: 'Apakah Anda yakin?',
                                                        text: "Data pasien akan dihapus dan tidak bisa dikembalikan!",
                                                        icon: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#3085d6',
                                                        cancelButtonColor: '#d33',
                                                        confirmButtonText: 'Ya, hapus!',
                                                        cancelButtonText: 'Batal'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            document.getElementById('delete-form-' + patientId).submit();
                                                        }
                                                    });
                                                }
                                            </script>
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $patient->id }})">Hapus</button>
                                    </div>
                                </td>
                               </tr>   
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
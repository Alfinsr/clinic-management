@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col">
        <!-- Form untuk mengedit data pasien -->
        <form action="/patients/{{ $patient->id }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Pop-up ketika update data pasien berhasil -->
            @if(session('patient_success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: 'Pasien Berhasil Diperbarui!',
                            html: "ID Pasien: {{ session('patient_success')['id'] }}<br>Nama: {{ session('patient_success')['name'] }}<br>Umur: {{ session('patient_success')['age'] }}",
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        });
                    });
                </script>
            @endif

            <!-- Pop-up ketika update data gagal -->
            @if ($errors->any())
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: 'Pasien Gagal Diperbarui!',
                            html: "{!! implode('<br>', $errors->all()) !!}",
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    });
                </script>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3>Data Pasien</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $patient->name) }}">
                            </div>
                            <div class="form-group">
                                <label for="gender">Jenis Kelamin</label>
                                <input class="form-control" type="text" name="gender" id="gender" value="{{ old('gender', $patient->gender) }}">
                            </div>
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <input class="form-control" type="text" name="address" id="address" value="{{ old('address', $patient->address) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="age">Umur</label>
                                <input class="form-control" type="text" name="age" id="age" value="{{ old('age', $patient->age) }}">
                            </div>
                            <div class="form-group">
                                <label for="birthday">Tanggal Lahir</label>
                                <input class="form-control" type="date" name="birthday" id="birthday" value="{{ old('birthday', $patient->birthday) }}">
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Nomor HP</label>
                                <input class="form-control" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $patient->phone_number) }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <a href="/patients" class="btn btn-outline-secondary mr-2">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>

        <!-- Tabel riwayat kunjungan pasien -->
        <div class="card mt-3">
            <div class="card-header">
                <h3>Riwayat Kunjungan</h3>
            </div>
            <div class="card-body">
                @if($patient->patientRecords->isEmpty())
                    <p>Belum ada riwayat kunjungan untuk pasien ini.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tanggal Kunjungan</th>
                                <th>Keluhan</th>
                                <th>Pengobatan</th>
                                <th>Tekanan Darah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patient->patientRecords as $record)
                                <tr>
                                    <td style="width: 15%">{{ \Carbon\Carbon::parse($record->visit_date)->translatedFormat('d F Y') }}</td>
                                    <td>{{ $record->complaint }}</td>
                                    <td>{{ $record->treatment }}</td>
                                    <td>{{ $record->blood_pressure }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <!-- Tombol tambah riwayat kunjungan di kanan bawah tabel -->
            <div class="card-footer d-flex justify-content-end">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addRecordModal">Tambah Riwayat Kunjungan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk menambahkan riwayat kunjungan baru -->
<div class="modal fade" id="addRecordModal" tabindex="-1" role="dialog" aria-labelledby="addRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('patientRecords.store', ['patient_id' => $patient->id]) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addRecordModalLabel">Tambah Riwayat Kunjungan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="visit_date">Tanggal Kunjungan</label>
                        <input type="date" class="form-control" id="visit_date" name="visit_date" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="complaint">Keluhan</label>
                        <input type="text" class="form-control" id="complaint" name="complaint" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="treatment">Pengobatan</label>
                        <input type="text" class="form-control" id="treatment" name="treatment" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="blood_pressure">Tekanan Darah</label>
                        <input type="text" class="form-control" id="blood_pressure" name="blood_pressure" autocomplete="off" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Riwayat</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

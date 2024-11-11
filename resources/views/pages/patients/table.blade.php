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
        @forelse ($data as $patient)
            <tr>
                <td>{{ $patient->id }}</td>
                <td>{{ $patient->name }}</td>
                <td>{{ $patient->gender }}</td>
                <td>{{ $patient->address }}</td>
                <td>{{ $patient->age }}</td>
                <td>{{ $patient->birthday }}</td>
                <td>{{ $patient->phone_number }}</td>
                <td>
                    <div class="d-flex">
                        <a href="/patients/edit/{{ $patient->id }}" class="btn btn-sm btn-warning mr-2">Edit</a>
                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $patient->id }})">Hapus</button>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">Data pasien tidak ditemukan.</td>
            </tr>
        @endforelse
    </tbody>
</table>

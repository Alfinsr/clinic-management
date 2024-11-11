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
                <div class="card-header d-flex justify-content-between align-items-center">
                    {{-- implementasi ajax --}}
                    <form class="form-inline col-sm-11" id="searchForm" onsubmit="return false;">
                        <div class="input-group input-group-sm" style="max-width: 300px;">
                            <input class="form-control" type="search" id="search" name="search" 
                                   placeholder="Cari Pasien" aria-label="Search" autocomplete="off">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" onclick="performSearch()">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <a href="/patients/add" class="btn btn-sm btn-success">
                        Tambah Pasien
                    </a>
                </div>
                <div class="card-body">
                    {{-- Tabel pasien  --}}
                    <div id="patientTable">
                        @include('pages.patients.table', ['data' => $data])
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let debounceTimer;
        document.getElementById('search').addEventListener('input', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(performSearch, 300); 
        });

        function performSearch() {
            const searchQuery = document.getElementById('search').value;

            fetch(`/patients?search=${searchQuery}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken 
                }
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById('patientTable').innerHTML = html;
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
@endsection

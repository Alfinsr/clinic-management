@extends('layouts.auth')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-4">
        <div class="card shadow-lg rounded-lg">
            <div class="card-header text-center bg-primary text-white">
                <h6>Login</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ url('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    @if(session('error'))
                        <div class="text-danger">{{ session('error') }}</div>
                    @endif

                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

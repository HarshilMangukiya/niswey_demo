@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm">
            <div class="card-header text-center bg-white">
                <h4 class="mb-0">Admin Login</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login.attempt') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Login as</label>
                        <select id="role" class="form-select">
                            <option value="">Select role</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var roleSelect = document.getElementById('role');
        var emailInput = document.getElementById('email');
        var passwordInput = document.getElementById('password');
        var adminEmail = @json(env('ADMIN_EMAIL', 'admin@gmail.com'));
        var adminPassword = @json(env('ADMIN_PASSWORD', 'unlock@Admin'));

        roleSelect && roleSelect.addEventListener('change', function () {
            if (this.value === 'admin') {
                emailInput.value = adminEmail;
                passwordInput.value = adminPassword;
            }
        });
    });
</script>
@endpush




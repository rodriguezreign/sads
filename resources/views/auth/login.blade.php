@extends('layouts.auth')

@section('title', 'Lost&Found - Login')

@section('auth-header')
    <div class="auth-header">      <h2>Lost and Found</h2>        <p>Welcome back! Please login to your account.</p>    </div>
@endsection

@section('auth-form')
    <form id="loginForm" method="POST" action="{{ route('login') }}">
        @csrf
        
        {{-- Error Message Display --}}
        @if($errors->any())
            <div class="alert alert-error" style="margin-bottom: 15px; display: flex;">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="form-group">
            <label class="form-label" for="username">Username or Email</label>
            <div style="position: relative;">
                <i class="fas fa-user" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
                <input type="text" id="username" name="username" class="form-control" 
                       placeholder="Enter your username" style="padding-left: 45px;" 
                       required value="{{ old('username') }}">
            </div>
        </div>
        
        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <div style="position: relative;">
                <i class="fas fa-lock" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
                <input type="password" id="password" name="password" class="form-control" 
                       placeholder="Enter your password" style="padding-left: 45px;" required>
            </div>
        </div>
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <label style="display: flex; align-items: center; gap: 8px; font-size: 14px; color: var(--text-muted); cursor: pointer;">
                <input type="checkbox" name="remember" style="width: 16px; height: 16px; accent-color: var(--primary-color);"> Remember me
            </label>
            <a href="#" style="color: var(--primary-color); text-decoration: none; font-size: 14px; font-weight: 500;">Forgot Password?</a>
        </div>
        
        <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 14px;">
            <i class="fas fa-sign-in-alt"></i> Login
        </button>
    </form>
@endsection

@section('auth-footer')
    <p style="color: var(--text-muted); font-size: 14px;">
        Don't have an account? <a href="{{ route('register') }}" style="color: var(--primary-color); text-decoration: none; font-weight: 600;">Register here</a>
    </p>
    
    {{-- Optional: Admin Login Link --}}
    <p style="margin-top: 15px; font-size: 12px; color: var(--text-muted);">
        <i class="fas fa-shield-alt"></i> Admin? Just login with your admin account
    </p>
@endsection

@push('auth-scripts')
<script>
    // Client-side validation
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value;
        
        if (!username || !password || password.length < 6) {
            e.preventDefault();
            alert('Please enter valid username and password (min 6 chars).');
            return false;
        }
    });
</script>
@endpush
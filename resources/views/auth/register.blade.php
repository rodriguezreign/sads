@extends('layouts.auth')

@section('title', 'Lost&Found - Register')

@section('auth-header')
    <div class="auth-header">
        <h2>Create Account</h2>
        <p>Join our Lost&Found community today!</p>
    </div>
@endsection

@section('auth-form')
    <form id="registerForm" method="POST" action="{{ route('register') }}">
        @csrf
        
        <div class="form-group">
    <label class="form-label" for="regUsername">Username</label>
    <div style="position: relative;">
        <i class="fas fa-user" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
        <input type="text" id="regUsername" name="name" class="form-control @error('name') is-invalid @enderror" 
               placeholder="Choose a username" style="padding-left: 45px;" required value="{{ old('name') }}">
    </div>
    @error('name')
        <span class="text-danger" style="color: var(--danger); font-size: 13px;">{{ $message }}</span>
    @enderror
</div>
        
        <div class="form-group">
            <label class="form-label" for="regEmail">Email Address</label>
            <div style="position: relative;">
                <i class="fas fa-envelope" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
                <input type="email" id="regEmail" name="email" class="form-control @error('email') is-invalid @enderror" 
                       placeholder="Enter your email" style="padding-left: 45px;" required value="{{ old('email') }}">
            </div>
            @error('email')
                <span class="text-danger" style="color: var(--danger); font-size: 13px;">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label class="form-label" for="regPassword">Password</label>
            <div style="position: relative;">
                <i class="fas fa-lock" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
                <input type="password" id="regPassword" name="password" class="form-control @error('password') is-invalid @enderror" 
                       placeholder="Min 6 characters" style="padding-left: 45px;" required>
            </div>
            @error('password')
                <span class="text-danger" style="color: var(--danger); font-size: 13px;">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label class="form-label" for="regConfirmPassword">Confirm Password</label>
            <div style="position: relative;">
                <i class="fas fa-lock" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
                <input type="password" id="regConfirmPassword" name="password_confirmation" class="form-control" 
                       placeholder="Confirm your password" style="padding-left: 45px;" required>
            </div>
        </div>
        
        <div class="form-group">
            <label style="display: flex; align-items: flex-start; gap: 10px; font-size: 14px; color: var(--text-muted); cursor: pointer;">
                <input type="checkbox" name="terms" required style="width: 16px; height: 16px; margin-top: 3px; accent-color: var(--primary-color);">
                <span>I agree to the <a href="#" style="color: var(--primary-color);">Terms of Service</a> and <a href="#" style="color: var(--primary-color);">Privacy Policy</a></span>
            </label>
        </div>
        
        <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 14px;">
            <i class="fas fa-user-plus"></i> Create Account
        </button>
        
        @if(session('success'))
            <div class="alert alert-success" style="margin-top: 15px; display: flex;">
                {{ session('success') }}
            </div>
        @endif
    </form>
@endsection

@section('auth-footer')
    <p style="color: var(--text-muted); font-size: 14px;">
        Already have an account? <a href="{{ route('login') }}" style="color: var(--primary-color); text-decoration: none; font-weight: 600;">Login here</a>
    </p>
@endsection

@push('auth-scripts')
<script>
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        const password = document.getElementById('regPassword').value;
        const confirmPassword = document.getElementById('regConfirmPassword').value;
        
        if (password !== confirmPassword) {
            e.preventDefault();
            alert('Passwords do not match.');
            return false;
        }
    });
</script>
@endpush
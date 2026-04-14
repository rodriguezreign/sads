@extends('layouts.app')

@section('body-class', 'auth-body')

@section('content')
    <div class="auth-container">
        <div class="auth-card">
            @yield('auth-header')
            
            <div class="auth-body-content">
                @yield('auth-form')
            </div>
            
            <div class="auth-footer">
                @yield('auth-footer')
            </div>
        </div>
    </div>

    @stack('auth-scripts')
@endsection
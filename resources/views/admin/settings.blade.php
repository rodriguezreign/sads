@extends('layouts.app')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('title', 'Admin Settings - Valex')

@section('page-title', 'Settings')
@section('breadcrumb', 'Admin / Settings')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">System Settings</h3>
    </div>
    <div class="card-body">
        <p>Settings page. Functionality to be implemented.</p>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
    </div>
</div>
@endsection

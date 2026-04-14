@extends('layouts.app')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('title', 'Admin Users - Valex')

@section('page-title', 'Manage Users')
@section('breadcrumb', 'Admin / Users')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Users Management</h3>
    </div>
    <div class="card-body">
        <p>Users management page. Functionality to be implemented.</p>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
    </div>
</div>
@endsection

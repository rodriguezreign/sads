@extends('layouts.app')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('title', 'Admin Claims - Valex')

@section('page-title', 'Manage Claims')
@section('breadcrumb', 'Admin / Claims')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Claims Management</h3>
    </div>
    <div class="card-body">
        <p>Claims management page. Functionality to be implemented.</p>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
    </div>
</div>
@endsection

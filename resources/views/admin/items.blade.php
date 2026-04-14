@extends('layouts.app')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('title', 'Admin Items - Valex')

@section('page-title', 'Manage Items')
@section('breadcrumb', 'Admin / Items')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Items Management</h3>
    </div>
    <div class="card-body">
        <p>Items management page. Functionality to be implemented.</p>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
    </div>
</div>
@endsection

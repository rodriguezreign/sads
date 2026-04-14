@extends('layouts.app')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('title', 'User Dashboard - Lost and Found')

@section('page-title', 'Welcome Back, ' . (auth()->user()->name ?? 'User') . '!')
@section('breadcrumb', 'Home / Dashboard')

@section('header-actions')
    {{-- DEBUG: Always show admin status --}}
    <!-- Admin Check: is_admin={{ auth()->user()->is_admin ?? 'NULL' }}, isAdmin={{ auth()->user()->isAdmin() ? 'true' : 'false' }} -->
    
    {{-- Admin Panel Button - Only for Admins --}}
    @if(auth()->user()->isAdmin())
        <a href="{{ route('admin.dashboard') }}" class="btn btn-danger" style="background-color: #dc3545; color: white; border: none; padding: 10px 20px; border-radius: 5px; text-decoration: none; margin-right: 10px; display: inline-flex; align-items: center; gap: 8px;">
            <i class="fas fa-shield-alt"></i> Admin Panel
        </a>
    @endif
    
    <button class="btn btn-primary" onclick="loadPage('report')">
        <i class="fas fa-plus"></i> Report Item
    </button>
@endsection

@section('content')
    <!-- Quick Stats -->
    <div class="stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
        @include('components.stat-card', [
            'icon' => 'fa-search',
            'count' => '5',
            'label' => 'My Lost Items',
            'type' => 'primary'
        ])
        @include('components.stat-card', [
            'icon' => 'fa-hand-holding',
            'count' => '3',
            'label' => 'Items Found',
            'type' => 'success'
        ])
        @include('components.stat-card', [
            'icon' => 'fa-clock',
            'count' => '2',
            'label' => 'Pending Claims',
            'type' => 'warning'
        ])
    </div>

    <!-- Recent Items -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">My Recent Items</h3>
            <a href="{{ route('myitems') }}" style="color: var(--primary-color); text-decoration: none; font-weight: 600; font-size: 14px;">View All</a>
        </div>
        <div style="display: grid; gap: 15px;">
            @include('components.item-row', [
                'icon' => 'fa-wallet',
                'iconBg' => 'var(--primary-color)',
                'title' => 'Black Leather Wallet',
                'description' => 'Lost at Central Park • 2 days ago',
                'badge' => 'Searching',
                'badgeClass' => 'badge-warning'
            ])
            @include('components.item-row', [
                'icon' => 'fa-mobile-alt',
                'iconBg' => 'var(--success)',
                'title' => 'iPhone 13 Pro',
                'description' => 'Found at Coffee Shop • Claimed',
                'badge' => 'Resolved',
                'badgeClass' => 'badge-success'
            ])
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Quick Actions</h3>
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
            <button class="btn btn-primary" style="justify-content: center; padding: 20px; flex-direction: column; gap: 10px;" onclick="loadPage('report')">
                <i class="fas fa-plus-circle" style="font-size: 24px;"></i>
                <span>Report Lost Item</span>
            </button>
            <button class="btn btn-outline" style="justify-content: center; padding: 20px; flex-direction: column; gap: 10px;" onclick="loadPage('found')">
                <i class="fas fa-hand-holding" style="font-size: 24px;"></i>
                <span>Report Found Item</span>
            </button>
            <button class="btn btn-outline" style="justify-content: center; padding: 20px; flex-direction: column; gap: 10px;" onclick="loadPage('browse')">
                <i class="fas fa-search" style="font-size: 24px;"></i>
                <span>Browse Items</span>
            </button>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('title', 'Admin Dashboard - Lost and Found')

@section('page-title', 'Dashboard')
@section('breadcrumb', 'Home / Dashboard')

@section('header-actions')
    <div style="display: flex; gap: 10px;">
        <button class="btn btn-outline">
            <i class="fas fa-download"></i> Export
        </button>
        <button class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New
        </button>
    </div>
@endsection

@section('content')
    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card primary">
            <div class="stat-icon"><i class="fas fa-box"></i></div>
            <div class="stat-info">
                <h3>{{ $stats['total_items'] }}</h3>
                <p>Total Items</p>
            </div>
        </div>
        <div class="stat-card success">
            <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
            <div class="stat-info">
                <h3>{{ $stats['resolved_cases'] }}</h3>
                <p>Resolved Cases</p>
            </div>
        </div>
        <div class="stat-card warning">
            <div class="stat-icon"><i class="fas fa-clock"></i></div>
            <div class="stat-info">
                <h3>{{ $stats['pending_claims'] }}</h3>
                <p>Pending Claims</p>
            </div>
        </div>
        <div class="stat-card danger">
            <div class="stat-icon"><i class="fas fa-users"></i></div>
            <div class="stat-info">
                <h3>{{ $stats['total_users'] }}</h3>
                <p>Total Users</p>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Recent Activity</h3>
            <a href="{{ route('admin.reports') }}" class="btn btn-outline" style="padding: 8px 16px; font-size: 13px;">View All</a>
        </div>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Item</th>
                        <th>Status</th>
                        <th>User</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recent_activity as $item)
                        <tr>
                            <td>#{{ $item->id }}</td>
                            <td><strong>{{ $item->item_name }}</strong></td>
                            <td>
                                <span class="badge {{ $item->getStatusBadgeClass() }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.reports') }}" class="btn btn-primary" style="padding: 6px 12px; font-size: 12px;">
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 20px;">No recent activity</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('title', 'My Items - Valex Lost&Found')

@section('page-title', 'My Items')
@section('breadcrumb', 'Home / My Items')

@section('header-actions')
    <button class="btn btn-primary" onclick="loadPage('report', this)">
        <i class="fas fa-plus"></i> Report New Item
    </button>
@endsection

@section('content')
    <div class="stats-grid" style="grid-template-columns: repeat(4, 1fr); margin-bottom: 25px;">
        <div class="stat-card primary">
            <div class="stat-icon"><i class="fas fa-box"></i></div>
            <div class="stat-info">
                <h3>{{ $stats['total'] }}</h3>
                <p>Total Reports</p>
            </div>
        </div>
        <div class="stat-card warning">
            <div class="stat-icon"><i class="fas fa-clock"></i></div>
            <div class="stat-info">
                <h3>{{ $stats['pending'] }}</h3>
                <p>Pending Review</p>
            </div>
        </div>
        <div class="stat-card success">
            <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
            <div class="stat-info">
                <h3>{{ $stats['approved'] }}</h3>
                <p>Approved</p>
            </div>
        </div>
        <div class="stat-card danger">
            <div class="stat-icon"><i class="fas fa-times-circle"></i></div>
            <div class="stat-info">
                <h3>{{ $stats['rejected'] }}</h3>
                <p>Rejected</p>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
            <h3 class="card-title">All My Reports</h3>
        </div>
        
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div style="width: 40px; height: 40px; background: var(--primary-color); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white;">
                                        <i class="fas fa-box"></i>
                                    </div>
                                    <div>
                                        <strong>{{ $item->item_name }}</strong>
                                        <p style="font-size: 12px; color: var(--text-muted); margin: 0;">#{{ $item->id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge {{ $item->getTypeBadgeClass() }}">
                                    {{ ucfirst($item->item_type) }}
                                </span>
                            </td>
                            <td>{{ $item->date->format('M d, Y') }}</td>
                            <td><i class="fas fa-map-marker-alt"></i> {{ Str::limit($item->location, 20) }}</td>
                            <td>
                                <span class="badge {{ $item->getStatusBadgeClass() }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                                @if($item->admin_notes)
                                    <i class="fas fa-info-circle" title="{{ $item->admin_notes }}" style="margin-left: 5px; color: var(--primary-color); cursor: pointer;"></i>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; gap: 8px;">
                                    <button class="btn btn-outline" style="padding: 6px 12px; font-size: 12px;">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px; color: var(--text-muted);">
                                <i class="fas fa-box-open" style="font-size: 48px; margin-bottom: 15px;"></i>
                                <p>No items reported yet. <a href="{{ route('report') }}">Report your first item!</a></p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{ $items->links() }}
    </div>
@endsection
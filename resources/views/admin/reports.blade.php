@extends('layouts.app')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('title', 'Reports Verification - Admin')

@section('page-title', 'Reports Verification')
@section('breadcrumb', 'Home / Reports')

@section('header-actions')
    <div style="display: flex; gap: 10px;">
        <button class="btn btn-outline" onclick="window.location.reload()">
            <i class="fas fa-sync-alt"></i> Refresh
        </button>
    </div>
@endsection

@section('content')
    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success" style="margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    {{-- Stats Overview --}}
    <div class="stats-grid" style="grid-template-columns: repeat(4, 1fr); margin-bottom: 25px;">
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
        <div class="stat-card primary">
            <div class="stat-icon"><i class="fas fa-box"></i></div>
            <div class="stat-info">
                <h3>{{ $stats['total'] }}</h3>
                <p>Total Items</p>
            </div>
        </div>
    </div>

    {{-- Pending Items Section --}}
    <div class="card" style="margin-bottom: 25px;">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
            <h3 class="card-title"><i class="fas fa-clock" style="color: var(--warning);"></i> Pending Verification</h3>
            <div style="display: flex; gap: 10px;">
                <button class="btn btn-success" onclick="bulkAction('approved')">
                    <i class="fas fa-check"></i> Approve Selected
                </button>
                <button class="btn btn-danger" onclick="bulkAction('rejected')">
                    <i class="fas fa-times"></i> Reject Selected
                </button>
            </div>
        </div>
        
        <form id="bulk-form" method="POST" action="{{ route('admin.reports.bulk') }}">
            @csrf
            <input type="hidden" name="status" id="bulk-status">
            
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all" onclick="toggleSelectAll()"></th>
                            <th>Item</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th>Reported By</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pending_items as $item)
                            <tr>
                                <td><input type="checkbox" name="item_ids[]" value="{{ $item->id }}" class="item-checkbox"></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px;">
                                            <i class="fas {{ $item->category === 'electronics' ? 'fa-mobile-alt' : ($item->category === 'wallet' ? 'fa-wallet' : ($item->category === 'keys' ? 'fa-key' : 'fa-box')) }}"></i>
                                        </div>
                                        <div>
                                            <strong>{{ $item->item_name }}</strong>
                                            <p style="font-size: 12px; color: var(--text-muted); margin: 0;">#{{ $item->id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge {{ $item->getTypeBadgeClass() }}" style="text-transform: uppercase;">
                                        {{ $item->item_type }}
                                    </span>
                                </td>
                                <td>{{ ucfirst($item->category) }}</td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="width: 30px; height: 30px; background: var(--primary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 12px;">
                                            {{ substr($item->user->name, 0, 1) }}
                                        </div>
                                        <span>{{ $item->user->name }}</span>
                                    </div>
                                </td>
                                <td>{{ $item->date->format('M d, Y') }}</td>
                                <td><i class="fas fa-map-marker-alt"></i> {{ Str::limit($item->location, 20) }}</td>
                                <td>
                                    <div style="display: flex; gap: 8px;">
                                        <button type="button" class="btn btn-success" onclick="showVerifyModal({{ $item->id }}, 'approved', '{{ $item->item_name }}')" style="padding: 6px 12px; font-size: 12px;">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" onclick="showVerifyModal({{ $item->id }}, 'rejected', '{{ $item->item_name }}')" style="padding: 6px 12px; font-size: 12px;">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline" onclick="showDetails({{ $item->id }})" style="padding: 6px 12px; font-size: 12px;">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            {{-- Hidden Details Row --}}
                            <tr id="details-{{ $item->id }}" style="display: none; background: var(--bg-light);">
                                <td colspan="8" style="padding: 20px;">
                                    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
                                        <div>
                                            <h4 style="margin-bottom: 10px;">Description</h4>
                                            <p style="color: var(--text-muted); margin-bottom: 15px;">{{ $item->description }}</p>
                                            
                                            <h4 style="margin-bottom: 10px;">Contact Info</h4>
                                            <p style="color: var(--text-muted);">{{ $item->contact_info ?? 'Not provided' }}</p>
                                        </div>
                                        @if($item->image)
                                            <div>
                                                <h4 style="margin-bottom: 10px;">Image</h4>
                                                <img src="{{ asset('storage/' . $item->image) }}" style="max-width: 200px; border-radius: 8px;">
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" style="text-align: center; padding: 40px; color: var(--text-muted);">
                                    <i class="fas fa-check-circle" style="font-size: 48px; margin-bottom: 15px; color: var(--success);"></i>
                                    <p>No pending items to verify. All caught up!</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </form>
        
        {{-- Pagination --}}
        <div style="padding: 20px; border-top: 1px solid var(--border-color);">
            {{ $pending_items->links() }}
        </div>
    </div>

    {{-- Recently Approved Section --}}
    <div class="card" style="margin-bottom: 25px;">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-check-circle" style="color: var(--success);"></i> Recently Approved</h3>
        </div>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Type</th>
                        <th>Reported By</th>
                        <th>Verified At</th>
                        <th>Verified By</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($approved_items as $item)
                        <tr>
                            <td>
                                <strong>{{ $item->item_name }}</strong>
                                <p style="font-size: 12px; color: var(--text-muted); margin: 0;">#{{ $item->id }}</p>
                            </td>
                            <td>
                                <span class="badge {{ $item->getTypeBadgeClass() }}">
                                    {{ $item->item_type }}
                                </span>
                            </td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->verified_at?->format('M d, Y H:i') }}</td>
                            <td>{{ $item->verifier?->name ?? 'System' }}</td>
                            <td><span class="badge badge-success">Approved</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 20px; color: var(--text-muted);">
                                No approved items yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Recently Rejected Section --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-times-circle" style="color: var(--danger);"></i> Recently Rejected</h3>
        </div>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Type</th>
                        <th>Reported By</th>
                        <th>Rejected At</th>
                        <th>Admin Notes</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rejected_items as $item)
                        <tr>
                            <td>
                                <strong>{{ $item->item_name }}</strong>
                                <p style="font-size: 12px; color: var(--text-muted); margin: 0;">#{{ $item->id }}</p>
                            </td>
                            <td>
                                <span class="badge {{ $item->getTypeBadgeClass() }}">
                                    {{ $item->item_type }}
                                </span>
                            </td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->verified_at?->format('M d, Y H:i') }}</td>
                            <td>{{ Str::limit($item->admin_notes, 30) }}</td>
                            <td><span class="badge badge-danger">Rejected</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 20px; color: var(--text-muted);">
                                No rejected items.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Verification Modal --}}
    <div id="verify-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
        <div style="background: white; border-radius: var(--radius); padding: 30px; max-width: 500px; width: 90%;">
            <h3 id="modal-title" style="margin-bottom: 20px;">Verify Item</h3>
            <p id="modal-item-name" style="color: var(--text-muted); margin-bottom: 20px;"></p>
            
            <form id="verify-form" method="POST" action="">
                @csrf
                <input type="hidden" name="status" id="modal-status">
                
                <div class="form-group" style="margin-bottom: 20px;">
                    <label class="form-label">Admin Notes (Optional)</label>
                    <textarea name="admin_notes" class="form-control" rows="3" placeholder="Add notes about this verification..."></textarea>
                </div>
                
                <div style="display: flex; gap: 15px;">
                    <button type="submit" id="modal-submit-btn" class="btn" style="flex: 1;">
                        Confirm
                    </button>
                    <button type="button" onclick="closeModal()" class="btn btn-outline" style="flex: 1;">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function toggleSelectAll() {
        const selectAll = document.getElementById('select-all');
        const checkboxes = document.querySelectorAll('.item-checkbox');
        checkboxes.forEach(cb => cb.checked = selectAll.checked);
    }

    function bulkAction(status) {
        const checked = document.querySelectorAll('.item-checkbox:checked');
        if (checked.length === 0) {
            alert('Please select at least one item.');
            return;
        }
        
        if (!confirm(`Are you sure you want to ${status} ${checked.length} items?`)) {
            return;
        }
        
        document.getElementById('bulk-status').value = status;
        document.getElementById('bulk-form').submit();
    }

    function showVerifyModal(itemId, status, itemName) {
        const modal = document.getElementById('verify-modal');
        const form = document.getElementById('verify-form');
        const title = document.getElementById('modal-title');
        const nameDisplay = document.getElementById('modal-item-name');
        const statusInput = document.getElementById('modal-status');
        const submitBtn = document.getElementById('modal-submit-btn');
        
        form.action = `/admin/reports/verify/${itemId}`;
        statusInput.value = status;
        nameDisplay.textContent = `Item: ${itemName}`;
        
        if (status === 'approved') {
            title.textContent = 'Approve Item';
            title.style.color = 'var(--success)';
            submitBtn.className = 'btn btn-success';
            submitBtn.innerHTML = '<i class="fas fa-check"></i> Approve';
        } else {
            title.textContent = 'Reject Item';
            title.style.color = 'var(--danger)';
            submitBtn.className = 'btn btn-danger';
            submitBtn.innerHTML = '<i class="fas fa-times"></i> Reject';
        }
        
        modal.style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('verify-modal').style.display = 'none';
    }

    function showDetails(itemId) {
        const row = document.getElementById(`details-${itemId}`);
        row.style.display = row.style.display === 'none' ? 'table-row' : 'none';
    }

    // Close modal on outside click
    document.getElementById('verify-modal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });
</script>
@endpush
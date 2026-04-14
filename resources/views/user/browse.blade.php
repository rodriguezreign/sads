@extends('layouts.app')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('title', 'Browse Items - Valex Lost&Found')

@section('page-title', 'Browse Items')
@section('breadcrumb', 'Home / Browse Items')

@section('header-actions')
    <button class="btn btn-primary" onclick="loadPage('report', this)">
        <i class="fas fa-plus"></i> Report Item
    </button>
@endsection

@section('content')
    <div class="card" style="margin-bottom: 25px;">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-filter"></i> Search & Filter</h3>
        </div>
        <div style="padding: 20px;">
            <div style="display: grid; grid-template-columns: 2fr 1fr 1fr auto; gap: 15px; align-items: end;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Search</label>
                    <div style="position: relative;">
                        <i class="fas fa-search" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
                        <input type="text" id="search-input" class="form-control" placeholder="Search items..." style="padding-left: 45px;">
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Type</label>
                    <select id="type-filter" class="form-control">
                        <option value="">All Types</option>
                        <option value="lost">Lost Items</option>
                        <option value="found">Found Items</option>
                    </select>
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Category</label>
                    <select id="category-filter" class="form-control">
                        <option value="">All Categories</option>
                        <option value="electronics">Electronics</option>
                        <option value="wallet">Wallet</option>
                        <option value="keys">Keys</option>
                        <option value="documents">Documents</option>
                        <option value="jewelry">Jewelry</option>
                        <option value="clothing">Clothing</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <button class="btn btn-primary" onclick="filterItems()" style="height: fit-content;">
                    <i class="fas fa-filter"></i> Filter
                </button>
            </div>
        </div>
    </div>

    <div style="margin-bottom: 20px; color: var(--text-muted);">
        Showing <strong>12</strong> of <strong>156</strong> items
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; margin-bottom: 30px;">
        <div class="card" style="overflow: hidden;">
            <div style="position: relative;">
                <div style="height: 180px; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); display: flex; align-items: center; justify-content: center; color: white; font-size: 60px;">
                    <i class="fas fa-wallet"></i>
                </div>
                <span class="badge badge-warning" style="position: absolute; top: 15px; right: 15px; padding: 8px 16px; font-size: 12px;">
                    LOST
                </span>
            </div>
            <div style="padding: 20px;">
                <h4 style="margin-bottom: 8px; color: var(--text-dark);">Black Leather Wallet</h4>
                <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 12px;">
                    <i class="fas fa-map-marker-alt"></i> Central Park, New York<br>
                    <i class="fas fa-calendar"></i> 2 days ago
                </p>
                <p style="color: var(--text-muted); font-size: 13px; margin-bottom: 15px; line-height: 1.5;">
                    Brown leather wallet with ID cards and some cash. Lost near the fountain area.
                </p>
                <div style="display: flex; gap: 10px;">
                    <button class="btn btn-primary" style="flex: 1; padding: 10px; font-size: 13px;">
                        <i class="fas fa-eye"></i> View Details
                    </button>
                    <button class="btn btn-outline" style="padding: 10px 15px; font-size: 13px;">
                        <i class="fas fa-comment"></i> Contact
                    </button>
                </div>
            </div>
        </div>

        <div class="card" style="overflow: hidden;">
            <div style="position: relative;">
                <div style="height: 180px; background: linear-gradient(135deg, var(--success), #2ecc71); display: flex; align-items: center; justify-content: center; color: white; font-size: 60px;">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <span class="badge badge-success" style="position: absolute; top: 15px; right: 15px; padding: 8px 16px; font-size: 12px;">
                    FOUND
                </span>
            </div>
            <div style="padding: 20px;">
                <h4 style="margin-bottom: 8px; color: var(--text-dark);">iPhone 13 Pro</h4>
                <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 12px;">
                    <i class="fas fa-map-marker-alt"></i> Starbucks Coffee<br>
                    <i class="fas fa-calendar"></i> 1 day ago
                </p>
                <p style="color: var(--text-muted); font-size: 13px; margin-bottom: 15px; line-height: 1.5;">
                    Found on table near window. Blue case with sticker. Screen has crack.
                </p>
                <div style="display: flex; gap: 10px;">
                    <button class="btn btn-primary" style="flex: 1; padding: 10px; font-size: 13px;">
                        <i class="fas fa-eye"></i> View Details
                    </button>
                    <button class="btn btn-outline" style="padding: 10px 15px; font-size: 13px;">
                        <i class="fas fa-hand-holding"></i> Claim
                    </button>
                </div>
            </div>
        </div>

        <div class="card" style="overflow: hidden;">
            <div style="position: relative;">
                <div style="height: 180px; background: linear-gradient(135deg, #f093fb, #f5576c); display: flex; align-items: center; justify-content: center; color: white; font-size: 60px;">
                    <i class="fas fa-key"></i>
                </div>
                <span class="badge badge-warning" style="position: absolute; top: 15px; right: 15px; padding: 8px 16px; font-size: 12px;">
                    LOST
                </span>
            </div>
            <div style="padding: 20px;">
                <h4 style="margin-bottom: 8px; color: var(--text-dark);">Car Keys with Keychain</h4>
                <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 12px;">
                    <i class="fas fa-map-marker-alt"></i> Mall Parking Lot<br>
                    <i class="fas fa-calendar"></i> 3 days ago
                </p>
                <p style="color: var(--text-muted); font-size: 13px; margin-bottom: 15px; line-height: 1.5;">
                    Honda car keys with red keychain and small flashlight attached.
                </p>
                <div style="display: flex; gap: 10px;">
                    <button class="btn btn-primary" style="flex: 1; padding: 10px; font-size: 13px;">
                        <i class="fas fa-eye"></i> View Details
                    </button>
                    <button class="btn btn-outline" style="padding: 10px 15px; font-size: 13px;">
                        <i class="fas fa-comment"></i> Contact
                    </button>
                </div>
            </div>
        </div>

        <div class="card" style="overflow: hidden;">
            <div style="position: relative;">
                <div style="height: 180px; background: linear-gradient(135deg, #4facfe, #00f2fe); display: flex; align-items: center; justify-content: center; color: white; font-size: 60px;">
                    <i class="fas fa-id-card"></i>
                </div>
                <span class="badge badge-success" style="position: absolute; top: 15px; right: 15px; padding: 8px 16px; font-size: 12px;">
                    FOUND
                </span>
            </div>
            <div style="padding: 20px;">
                <h4 style="margin-bottom: 8px; color: var(--text-dark);">Student ID Card</h4>
                <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 12px;">
                    <i class="fas fa-map-marker-alt"></i> University Library<br>
                    <i class="fas fa-calendar"></i> Today
                </p>
                <p style="color: var(--text-muted); font-size: 13px; margin-bottom: 15px; line-height: 1.5;">
                    Found on study table. Name: John Doe. ID: 2024-XXXX
                </p>
                <div style="display: flex; gap: 10px;">
                    <button class="btn btn-primary" style="flex: 1; padding: 10px; font-size: 13px;">
                        <i class="fas fa-eye"></i> View Details
                    </button>
                    <button class="btn btn-outline" style="padding: 10px 15px; font-size: 13px;">
                        <i class="fas fa-hand-holding"></i> Claim
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
        <button class="btn btn-outline" disabled style="opacity: 0.5;">
            <i class="fas fa-chevron-left"></i> Previous
        </button>
        <div style="display: flex; gap: 5px;">
            <button class="btn btn-primary" style="padding: 8px 16px;">1</button>
            <button class="btn btn-outline" style="padding: 8px 16px;">2</button>
            <button class="btn btn-outline" style="padding: 8px 16px;">3</button>
            <span style="padding: 8px;">...</span>
            <button class="btn btn-outline" style="padding: 8px 16px;">13</button>
        </div>
        <button class="btn btn-outline">
            Next <i class="fas fa-chevron-right"></i>
        </button>
    </div>
@endsection
@extends('layouts.app')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('title', 'Report Item - Valex Lost&Found')

@section('page-title', 'Report Item')
@section('breadcrumb', 'Home / Report Item')

@section('header-actions')
    <a href="{{ route('myitems') }}" class="btn btn-outline">
        <i class="fas fa-list"></i> My Items
    </a>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Report Lost or Found Item</h3>
        </div>
        
        <form method="POST" action="{{ route('report.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div class="form-group">
                    <label class="form-label">Item Type *</label>
                    <div style="display: flex; gap: 15px;">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; padding: 10px 20px; border: 2px solid var(--primary-color); border-radius: 8px; flex: 1; justify-content: center;">
                            <input type="radio" name="item_type" value="lost" required style="accent-color: var(--primary-color);">
                            <span><i class="fas fa-search"></i> I Lost Something</span>
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; padding: 10px 20px; border: 2px solid var(--success); border-radius: 8px; flex: 1; justify-content: center;">
                            <input type="radio" name="item_type" value="found" required style="accent-color: var(--success);">
                            <span><i class="fas fa-hand-holding"></i> I Found Something</span>
                        </label>
                    </div>
                    @error('item_type')
                        <span style="color: var(--danger); font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Category *</label>
                    <select name="category" class="form-control" required>
                        <option value="">Select Category</option>
                        <option value="electronics">Electronics (Phone, Laptop, etc.)</option>
                        <option value="wallet">Wallet / Purse</option>
                        <option value="keys">Keys</option>
                        <option value="documents">Documents / ID / Cards</option>
                        <option value="jewelry">Jewelry / Watch</option>
                        <option value="clothing">Clothing / Bag</option>
                        <option value="pet">Pet / Animal</option>
                        <option value="other">Other</option>
                    </select>
                    @error('category')
                        <span style="color: var(--danger); font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label class="form-label">Item Name *</label>
                <input type="text" name="item_name" class="form-control" placeholder="e.g., Black Leather Wallet, iPhone 13 Pro" required value="{{ old('item_name') }}">
                @error('item_name')
                    <span style="color: var(--danger); font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label class="form-label">Description *</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Describe the item in detail (color, brand, distinguishing marks, etc.)" required>{{ old('description') }}</textarea>
                @error('description')
                    <span style="color: var(--danger); font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div class="form-group">
                    <label class="form-label">Location *</label>
                    <div style="position: relative;">
                        <i class="fas fa-map-marker-alt" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
                        <input type="text" name="location" class="form-control" placeholder="Where was it lost/found?" style="padding-left: 45px;" required value="{{ old('location') }}">
                    </div>
                    @error('location')
                        <span style="color: var(--danger); font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Date *</label>
                    <div style="position: relative;">
                        <i class="fas fa-calendar" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
                        <input type="date" name="date" class="form-control" style="padding-left: 45px;" required value="{{ old('date') }}">
                    </div>
                    @error('date')
                        <span style="color: var(--danger); font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label class="form-label">Additional Contact Info (Optional)</label>
                <input type="text" name="contact_info" class="form-control" placeholder="Phone number or alternative email" value="{{ old('contact_info') }}">
                @error('contact_info')
                    <span style="color: var(--danger); font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom: 25px;">
                <label class="form-label">Upload Image (Optional)</label>
                <div style="border: 2px dashed var(--border-color); border-radius: var(--radius); padding: 30px; text-align: center;">
                    <input type="file" name="image" id="image-input" accept="image/*" style="display: none;" onchange="previewImage(this)">
                    <label for="image-input" style="cursor: pointer;">
                        <i class="fas fa-cloud-upload-alt" style="font-size: 48px; color: var(--primary-color); margin-bottom: 15px; display: block;"></i>
                        <p style="color: var(--text-muted); margin-bottom: 10px;">Click to upload or drag and drop</p>
                        <p style="font-size: 12px; color: var(--text-muted);">PNG, JPG up to 2MB</p>
                    </label>
                    <img id="image-preview" style="max-width: 200px; max-height: 200px; margin-top: 15px; display: none; border-radius: 8px;">
                </div>
                @error('image')
                    <span style="color: var(--danger); font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; gap: 15px;">
                <button type="submit" class="btn btn-primary" style="flex: 1; padding: 14px;">
                    <i class="fas fa-paper-plane"></i> Submit Report
                </button>
                <a href="{{ route('dashboard') }}" class="btn btn-outline" style="flex: 1; padding: 14px; text-align: center;">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
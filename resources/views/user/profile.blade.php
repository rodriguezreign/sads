@extends('layouts.app')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('title', 'My Profile - Valex Lost&Found')

@section('page-title', 'My Profile')
@section('breadcrumb', 'Home / Profile')

@section('content')
    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 25px;">
        
        <div>
            <div class="card" style="text-align: center; padding: 30px;">
                <div style="position: relative; display: inline-block; margin-bottom: 20px;">
                    <div style="width: 120px; height: 120px; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 48px; margin: 0 auto;">
                        <i class="fas fa-user"></i>
                    </div>
                    <label for="avatar-upload" style="position: absolute; bottom: 5px; right: 5px; width: 35px; height: 35px; background: var(--primary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; cursor: pointer; border: 3px solid white;">
                        <i class="fas fa-camera" style="font-size: 14px;"></i>
                    </label>
                    <input type="file" id="avatar-upload" style="display: none;" accept="image/*">
                </div>
                
                <h3 style="margin-bottom: 5px;">{{ auth()->user()->name }}</h3>
                <p style="color: var(--text-muted); margin-bottom: 20px;">{{ auth()->user()->email }}</p>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; padding-top: 20px; border-top: 1px solid var(--border-color);">
                    <div>
                        <h4 style="color: var(--primary-color);">8</h4>
                        <p style="font-size: 12px; color: var(--text-muted);">Reports</p>
                    </div>
                    <div>
                        <h4 style="color: var(--success);">5</h4>
                        <p style="font-size: 12px; color: var(--text-muted);">Resolved</p>
                    </div>
                    <div>
                        <h4 style="color: var(--warning);">3</h4>
                        <p style="font-size: 12px; color: var(--text-muted);">Active</p>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-top: 20px;">
                <div class="card-header">
                    <h4 class="card-title">Account Status</h4>
                </div>
                <div style="padding: 20px;">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px;">
                        <i class="fas fa-check-circle" style="color: var(--success); font-size: 20px;"></i>
                        <div>
                            <p style="margin: 0; font-weight: 500;">Email Verified</p>
                            <p style="font-size: 12px; color: var(--text-muted); margin: 0;">{{ auth()->user()->email_verified_at ? 'Verified on ' . auth()->user()->email_verified_at->format('M d, Y') : 'Not verified' }}</p>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-shield-alt" style="color: var(--primary-color); font-size: 20px;"></i>
                        <div>
                            <p style="margin: 0; font-weight: 500;">Account Type</p>
                            <p style="font-size: 12px; color: var(--text-muted); margin: 0;">{{ auth()->user()->isAdmin() ? 'Administrator' : 'Standard User' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="card" style="margin-bottom: 25px;">
                <div class="card-header">
                    <h3 class="card-title">Profile Information</h3>
                </div>
                <form method="POST" action="{{ route('profile.update') }}" style="padding: 25px;">
                    @csrf
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div class="form-group">
                            <label class="form-label">Full Name *</label>
                            <div style="position: relative;">
                                <i class="fas fa-user" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
                                <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required style="padding-left: 45px;">
                            </div>
                            @error('name')
                                <span style="color: var(--danger); font-size: 13px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email Address *</label>
                            <div style="position: relative;">
                                <i class="fas fa-envelope" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
                                <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required style="padding-left: 45px;">
                            </div>
                            @error('email')
                                <span style="color: var(--danger); font-size: 13px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label class="form-label">Phone Number</label>
                        <div style="position: relative;">
                            <i class="fas fa-phone" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
                            <input type="tel" name="phone" class="form-control" placeholder="Optional contact number" style="padding-left: 45px;">
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label class="form-label">Bio</label>
                        <textarea name="bio" class="form-control" rows="3" placeholder="Tell us a little about yourself..."></textarea>
                    </div>

                    <div style="display: flex; gap: 15px;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                        <button type="reset" class="btn btn-outline">Cancel</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Change Password</h3>
                </div>
                <form method="POST" action="{{ route('profile.password') }}" style="padding: 25px;">
                    @csrf
                    
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label class="form-label">Current Password *</label>
                        <div style="position: relative;">
                            <i class="fas fa-lock" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
                            <input type="password" name="current_password" class="form-control" placeholder="Enter current password" required style="padding-left: 45px;">
                        </div>
                        @error('current_password')
                            <span style="color: var(--danger); font-size: 13px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div class="form-group">
                            <label class="form-label">New Password *</label>
                            <div style="position: relative;">
                                <i class="fas fa-key" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
                                <input type="password" name="password" class="form-control" placeholder="Min 6 characters" required style="padding-left: 45px;">
                            </div>
                            @error('password')
                                <span style="color: var(--danger); font-size: 13px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Confirm Password *</label>
                            <div style="position: relative;">
                                <i class="fas fa-key" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm new password" required style="padding-left: 45px;">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-danger" style="background: var(--danger); color: white; border: none;">
                        <i class="fas fa-lock"></i> Update Password
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
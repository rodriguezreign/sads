<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-header">
        <h2>Valex</h2>
    </div>
    
    @auth
        @if(auth()->user()->isAdmin())
            {{-- Admin Sidebar --}}
            <ul>
                <li class="{{ request()->is('admin') ? 'active' : '' }}" onclick="loadPage('dashboard', this)">
                    <i class="fas fa-home"></i> Dashboard
                </li>
                <li class="{{ request()->is('admin/users') ? 'active' : '' }}" onclick="loadPage('users', this)">
                    <i class="fas fa-users"></i> Manage Users
                </li>
                <li class="{{ request()->is('admin/items') ? 'active' : '' }}" onclick="loadPage('items', this)">
                    <i class="fas fa-box"></i> Manage Items
                </li>
                <li class="{{ request()->is('admin/claims') ? 'active' : '' }}" onclick="loadPage('claims', this)">
                    <i class="fas fa-clipboard-check"></i> Claims
                </li>
                <li class="{{ request()->is('admin/reports') ? 'active' : '' }}" onclick="loadPage('reports', this)">
                    <i class="fas fa-chart-bar"></i> Reports
                </li>
                <li class="{{ request()->is('admin/settings') ? 'active' : '' }}" onclick="loadPage('settings', this)">
                    <i class="fas fa-cog"></i> Settings
                </li>
            </ul>
        @else
            {{-- User Sidebar --}}
            <ul>
                <li class="{{ request()->is('dashboard') ? 'active' : '' }}" onclick="loadPage('home', this)">
                    <i class="fas fa-home"></i> Home
                </li>
                <li class="{{ request()->is('report') ? 'active' : '' }}" onclick="loadPage('report', this)">
                    <i class="fas fa-plus-circle"></i> Report Item
                </li>
                <li class="{{ request()->is('browse') ? 'active' : '' }}" onclick="loadPage('browse', this)">
                    <i class="fas fa-search"></i> Browse Items
                </li>
                <li class="{{ request()->is('myitems') ? 'active' : '' }}" onclick="loadPage('myitems', this)">
                    <i class="fas fa-list"></i> My Items
                </li>
                <li class="{{ request()->is('profile') ? 'active' : '' }}" onclick="loadPage('profile', this)">
                    <i class="fas fa-user"></i> Profile
                </li>
            </ul>
        @endif
    @endauth
    
    <div class="sidebar-footer">
        {{-- Laravel Logout Form --}}
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        
        {{-- Logout with return false to prevent default --}}
        <a href="#" onclick="return logout()" style="display: flex; align-items: center; gap: 12px; color: rgba(255,255,255,0.8); padding: 12px; text-decoration: none; border-radius: 8px; transition: all 0.3s;">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</div>
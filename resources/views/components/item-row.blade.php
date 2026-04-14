@props(['icon', 'iconBg', 'title', 'description', 'badge', 'badgeClass'])

<div style="display: flex; align-items: center; padding: 20px; background: var(--bg-light); border-radius: var(--radius); border-left: 4px solid {{ $iconBg }};">
    <div style="width: 50px; height: 50px; background: {{ $iconBg }}; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; margin-right: 20px;">
        <i class="fas {{ $icon }}"></i>
    </div>
    <div style="flex: 1;">
        <h4 style="margin-bottom: 5px; color: var(--text-dark);">{{ $title }}</h4>
        <p style="color: var(--text-muted); font-size: 14px;">{{ $description }}</p>
    </div>
    <span class="badge {{ $badgeClass }}">{{ $badge }}</span>
</div>
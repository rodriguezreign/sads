@props(['icon', 'count', 'label', 'type' => 'primary'])

<div class="stat-card {{ $type }}">
    <div class="stat-icon">
        <i class="fas {{ $icon }}"></i>
    </div>
    <div class="stat-info">
        <h3>{{ $count }}</h3>
        <p>{{ $label }}</p>
    </div>
</div>
<header class="d-flex justify-content-between align-items-center mb-1">
    <div>
        <div class="header-sub">GLOWCUT &nbsp;•&nbsp; KASIR</div>
        <h1 class="header-title font-serif">{{ $title }}</h1>
        <div class="header-date">{{ $date ?? 'Hari ini' }}</div>
    </div>
    <div class="d-flex gap-2">
        @if (!empty($backRoute))
            <a href="{{ $backRoute }}" class="btn-circle-icon" title="Kembali ke Dashboard">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
        @endif
        @if ($showLogout ?? true)
            <a href="/logout" class="btn-circle-icon" title="Keluar">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </a>
        @endif
    </div>
</header>

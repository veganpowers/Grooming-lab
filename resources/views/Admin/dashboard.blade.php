@extends('layouts.app')
@section('content')
<div class="admin-dashboard" x-data="{ activeMenu: 'dashboard', employeeModalOpen: false, employeeFormOpen: false }">
    <header class="admin-hero">
        <div>
            <p class="admin-kicker">GLONCUT · ADMIN PANEL</p>
            <h1>Dashboard Admin</h1>
            <p class="admin-date">{{ now()->translatedFormat('l, d F Y') }}</p>
        </div>
        <button class="admin-icon-button" type="button" data-theme-toggle aria-label="Aktifkan mode terang"><span data-theme-icon aria-hidden="true">☼</span></button>
    </header>

    <section class="admin-stat-grid" aria-label="Ringkasan hari ini">
        <article class="admin-stat-card admin-stat-card-gold"><span class="admin-stat-icon">◉</span><strong>Rp {{ number_format($todayRevenue, 0, ',', '.') }}</strong><small>Total Pendapatan</small><em>+12% vs minggu lalu</em></article>
        <article class="admin-stat-card admin-stat-card-teal"><span class="admin-stat-icon">▦</span><strong>{{ $todayBookings->count() }}</strong><small>Booking Hari Ini</small><em>{{ $todayBookings->whereIn('status', ['pending', 'confirmed'])->count() }} menunggu proses</em></article>
        <article class="admin-stat-card admin-stat-card-violet"><span class="admin-stat-icon">♟</span><strong>{{ $employees->where('role', 'cashier')->count() }}</strong><small>Karyawan Aktif</small><em>Semua hadir hari ini</em></article>
        <article class="admin-stat-card admin-stat-card-rose"><span class="admin-stat-icon">★</span><strong>{{ $todayBookings->where('status', 'completed')->count() }}</strong><small>Layanan Selesai</small><em>Hari ini</em></article>
    </section>

    <section class="admin-action-grid" aria-label="Aksi admin">
        <button class="admin-action admin-action-primary" type="button" @click="employeeModalOpen = true"><span>♟</span>Kelola Karyawan</button>
        <a class="admin-action admin-action-secondary" href="#revenue"><span>Rp</span>Laporan Pendapatan</a>
    </section>

    <section class="admin-panel admin-revenue-panel" id="revenue">
        <div class="admin-panel-heading"><div><h2>Pendapatan Minggu Ini</h2><p>Ringkasan pemasukan 7 hari terakhir</p></div><strong>Rp {{ number_format($weeklyRevenue->sum(), 0, ',', '.') }}</strong></div>
        <div class="admin-chart" aria-label="Grafik pendapatan minggu ini">
            @php($maxRevenue = max($weeklyRevenue->max(), 1))
            @foreach($weeklyRevenue as $index => $revenue)
                <div class="admin-chart-column"><span style="height: {{ max(($revenue / $maxRevenue) * 100, $revenue > 0 ? 14 : 5) }}%" title="Rp {{ number_format($revenue, 0, ',', '.') }}"></span><small>{{ now()->subDays(6 - $index)->translatedFormat('D') }}</small></div>
            @endforeach
        </div>
    </section>

    <section class="admin-section" id="employees">
        <div class="admin-section-heading"><h2>Daftar Karyawan</h2><button type="button" @click="employeeModalOpen = true">Kelola</button></div>
        <div class="admin-employee-list">
            @forelse($employees as $employee)
                <article class="admin-employee-row"><span class="admin-avatar">{{ strtoupper(substr($employee->name, 0, 1)) }}</span><div><strong>{{ $employee->name }}</strong><small>{{ $employee->username ?? $employee->email }}</small></div><span class="admin-employee-meta"><b>{{ $employee->role === 'admin' ? 'Full access' : 'Kasir' }}</b><em>Aktif</em></span></article>
            @empty
                <p class="admin-empty">Belum ada karyawan terdaftar.</p>
            @endforelse
        </div>
    </section>

    <section class="admin-employee-modal" x-show="employeeModalOpen" x-transition x-cloak @keydown.escape.window="employeeModalOpen = false" role="dialog" aria-modal="true" aria-labelledby="employee-modal-title">
        <div class="admin-employee-modal-panel">
            <div class="admin-modal-heading"><div><p class="admin-kicker">ADMIN PANEL</p><h2 id="employee-modal-title">Kelola Karyawan</h2></div><button class="admin-modal-close" type="button" @click="employeeModalOpen = false" aria-label="Tutup">×</button></div>
            <div class="admin-modal-list">
                @foreach($employees as $employee)
                    <div class="admin-modal-employee"><span class="admin-avatar">{{ strtoupper(substr($employee->name, 0, 1)) }}</span><div><strong>{{ $employee->name }}</strong><small>{{ $employee->username ?? $employee->email }} · {{ $employee->role === 'admin' ? 'Admin' : 'Kasir' }}</small></div><span class="admin-online-dot" aria-label="Aktif"></span></div>
                @endforeach
            </div>
            <button class="admin-add-employee" type="button" @click="employeeFormOpen = !employeeFormOpen"><span>+</span> Tambah Karyawan</button>
            <form class="admin-employee-form" method="POST" action="{{ route('admin.employees.store') }}" x-show="employeeFormOpen" x-transition>
                @csrf
                <label>Nama lengkap<input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Budi Santoso" required></label>
                <label>Username<input type="text" name="username" value="{{ old('username') }}" placeholder="Contoh: budi.santoso" pattern="[A-Za-z0-9_-]+" required></label>
                <label>Password<input type="password" name="password" placeholder="Minimal 8 karakter" required></label>
                <label>Ulangi password<input type="password" name="password_confirmation" placeholder="Ulangi password" required></label>
                <button class="admin-save-employee" type="submit">Buat Akun Karyawan</button>
            </form>
        </div>
    </section>

    <nav class="admin-bottom-nav" aria-label="Navigasi admin"><a class="is-active" href="{{ route('admin.dashboard') }}"><span>⌂</span>Beranda</a><a href="#employees"><span>♟</span>Karyawan</a><a href="#revenue"><span>▤</span>Laporan</a><form method="POST" action="{{ route('logout') }}">@csrf<button type="submit"><span>↪</span>Keluar</button></form></nav>
</div>
@endsection

@extends('layouts.app')
@section('content')
<div class="dashboard-head {{ auth()->user()->role === 'customer' ? 'customer-dashboard-head' : '' }}"><div><p class="eyebrow">{{ strtoupper(auth()->user()->role) }} DESK · RUANG RIAS</p><h1>{{ auth()->user()->role === 'customer' ? 'Atur kunjunganmu.' : 'Dashboard Kasir' }}</h1><p class="muted">{{ now()->translatedFormat('l, d F Y') }}</p></div>@if(auth()->user()->role === 'customer')<span class="status-pill">{{ $bookings->count() }} booking</span>@endif</div>
@if(auth()->user()->role === 'customer')
<div class="customer-dashboard">
	<button class="theme-toggle dashboard-theme-toggle" type="button" data-theme-toggle aria-label="Aktifkan mode terang"><span data-theme-icon aria-hidden="true">☼</span></button>
	<header class="customer-welcome"><div><p class="dashboard-eyebrow">SELAMAT DATANG KEMBALI</p><h1>{{ auth()->user()->name }} <span aria-hidden="true">👋</span></h1></div><button class="notification-button" type="button" aria-label="Notifikasi">♧<i></i></button></header>
	<label class="dashboard-search"><span aria-hidden="true">⌕</span><input type="search" placeholder="Cari layanan atau stylist..."></label>
	<section class="promo-strip" aria-label="Promo terbaru"><article class="promo-card promo-card-gold"><p>WISUDA SPECIAL</p><strong>Diskon 30%</strong><span>Haircut + Cream Bath</span></article><article class="promo-card promo-card-teal"><p>TERBARU</p><strong>Paket MUA</strong><span>Makeup + Sanggul</span></article></section>
	<section class="dashboard-section"><div class="dashboard-section-heading"><h2>Layanan</h2><a href="#booking-form">Lihat semua</a></div><div class="service-list">@foreach($services as $service)<a class="service-item" href="#booking-form"><span class="service-icon">{{ $loop->index === 0 ? '✂' : ($loop->index === 1 ? '⚒' : ($loop->index === 2 ? '💄' : '✦')) }}</span><strong>{{ $service->name }}</strong></a>@endforeach</div></section>
	<a class="button dashboard-book-button" href="#booking-form">Booking Sekarang</a>
	<section class="dashboard-section"><div class="dashboard-section-heading"><h2>Stylist Terpopuler</h2><a href="#booking-form">Lihat semua</a></div><div class="stylist-list"><article class="stylist-row"><span class="stylist-avatar stylist-avatar-one">✂</span><div><strong>Budi S.</strong><small>Senior Barber</small></div><b>★ 4.9</b></article><article class="stylist-row"><span class="stylist-avatar stylist-avatar-two">💄</span><div><strong>Rina A.</strong><small>MUA Artist</small></div><b>★ 4.8</b></article></div></section>
	<section class="customer-booking-area" id="booking-form"><div class="dashboard-section-heading"><h2>Booking baru</h2><span class="accent-mark">01</span></div><form method="POST" action="{{ route('bookings.store') }}" class="booking-form">@csrf<label>Layanan<select name="service_id" required><option value="">Pilih layanan</option>@foreach($services as $service)<option value="{{ $service->id }}">{{ $service->name }} · Rp {{ number_format($service->price, 0, ',', '.') }}</option>@endforeach</select></label><label>Waktu kunjungan<input type="datetime-local" name="appointment_at" min="{{ now()->addHour()->format('Y-m-d\\TH:i') }}" required></label><label>Catatan (opsional)<textarea name="notes" rows="3" placeholder="Contoh: low fade, bagian atas jangan terlalu pendek"></textarea></label><button class="button button-primary" type="submit">Konfirmasi booking</button></form></section>
	<section class="customer-bookings"><div class="dashboard-section-heading"><h2>Booking saya</h2><span class="accent-mark">{{ $bookings->count() }}</span></div>@forelse($bookings as $booking)<article class="booking-row"><div><strong>{{ $booking->service->name }}</strong><p>{{ $booking->appointment_at->format('d M Y, H:i') }} · Rp {{ number_format($booking->service->price, 0, ',', '.') }}</p></div><span class="status status-{{ $booking->status }}">{{ ucfirst($booking->status) }}</span></article>@empty<p class="muted">Belum ada booking. Pilih waktu terbaikmu.</p>@endforelse</section>
	<nav class="dashboard-bottom-nav" aria-label="Navigasi utama"><a class="is-active" href="{{ route('dashboard') }}"><span>⌂</span>Beranda</a><a href="#booking-form"><span>▦</span>Booking</a><a href="#booking-form"><span>▤</span>Riwayat</a><form method="POST" action="{{ route('logout') }}">@csrf<button type="submit"><span>♟</span>Profil</button></form></nav>
</div>
@else
<div class="cashier-dashboard" style="max-width: 1080px; margin: 0 auto; position: relative; padding-top: 52px; color: #f7f3eb;" x-data="{
    walkInOpen: false,
    developmentNoticeOpen: false,
    serviceType: 'barber',
    selectedService: null,
    statusFilter: 'all',
    barberServices: [
        { name: 'Fast Hair Cut', price: 25000 },
        { name: 'Rileks Ganteng', price: 35000 },
        { name: 'Full Grooming', price: 50000 }
    ],
    muaServices: [
        { name: 'Make Up Only', price: 250000 },
        { name: 'Make Up + Soft Lens', price: 300000 },
        { name: 'Make Up + Hair Do', price: 320000 }
    ],
    get services() { return this.serviceType === 'barber' ? this.barberServices : this.muaServices; }
}">
    <button class="theme-toggle dashboard-theme-toggle" type="button" data-theme-toggle aria-label="Aktifkan mode terang"><span data-theme-icon aria-hidden="true">☼</span></button>

    <div style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 16px; margin-bottom: 24px; text-align: center;">
        <div class="cashier-stat-card" style="background: rgba(21, 21, 21, 0.85); border: 1px solid #302d29; border-radius: 16px; padding: 18px 12px; backdrop-filter: blur(10px);">
            <div style="font-size: 11px; font-family: 'DM Mono', monospace; color: #8b8177; text-transform: uppercase; margin-bottom: 6px;">BOOKING</div>
            <div style="font-family: 'Playfair Display', serif; color: #e1bc55; font-size: 22px; font-weight: 600;">Rp 204k</div>
            <div style="font-size: 11px; color: #726b63; margin-top: 4px;">2 selesai</div>
        </div>
        <div class="cashier-stat-card" style="background: rgba(21, 21, 21, 0.85); border: 1px solid #302d29; border-radius: 16px; padding: 18px 12px; backdrop-filter: blur(10px);">
            <div style="font-size: 11px; font-family: 'DM Mono', monospace; color: #8b8177; text-transform: uppercase; margin-bottom: 6px;">WALK-IN</div>
            <div style="font-family: 'Playfair Display', serif; color: #e1bc55; font-size: 22px; font-weight: 600;">Rp 215k</div>
            <div style="font-size: 11px; color: #726b63; margin-top: 4px;">3 transaksi</div>
        </div>
        <div class="cashier-stat-card" style="background: rgba(21, 21, 21, 0.85); border: 1px solid #302d29; border-radius: 16px; padding: 18px 12px; backdrop-filter: blur(10px);">
            <div style="font-size: 11px; font-family: 'DM Mono', monospace; color: #8b8177; text-transform: uppercase; margin-bottom: 6px;">TOTAL</div>
            <div style="font-family: 'Playfair Display', serif; color: #e1bc55; font-size: 22px; font-weight: 600;">Rp 419k</div>
            <div style="font-size: 11px; color: #726b63; margin-top: 4px;">Hari ini</div>
        </div>
    </div>

    <button class="cashier-main-action" type="button" @click="walkInOpen = true" style="width: 100%; background: #e1bc55; border: 0; border-radius: 16px; color: #0b0b0b; font-weight: 700; padding: 16px; font-size: 15px; margin-bottom: 22px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 8px 20px rgba(225,188,85,0.15);">
        <span style="font-size: 20px; line-height: 1;">+</span> Catat Pelanggan Walk-in
    </button>

    <div class="cashier-walkin-modal" x-show="walkInOpen" x-transition style="position: fixed; inset: 0; background: rgba(10, 10, 10, 0.7); display: flex; align-items: center; justify-content: center; padding: 20px; z-index: 50;">
        <div class="cashier-walkin-panel" style="width: min(560px, calc(100vw - 28px)); max-height: min(85vh, 760px); overflow-y: auto; background: #121212; border: 1px solid #2f2f2f; border-radius: 26px; padding: 26px; box-shadow: 0 30px 90px rgba(0,0,0,0.45); color: #f7f3eb; box-sizing: border-box; margin: 0 auto;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;">
                <div>
                    <div style="font-family: 'DM Mono', monospace; font-size: 10px; letter-spacing: 1px; color: #c6b078; text-transform: uppercase; margin-bottom: 6px;">Walk-in</div>
                    <h3 style="margin: 0; font-size: 28px; font-family: 'Playfair Display', serif;">Pelanggan Baru</h3>
                </div>
                <button type="button" @click="walkInOpen = false; selectedService = null" style="background: #1c1c1c; border: 1px solid #3a3a3a; border-radius: 12px; color: #f7f3eb; width: 38px; height: 38px; font-size: 22px; cursor: pointer;">×</button>
            </div>

            <div style="display: grid; gap: 18px;">
                <label style="display: grid; gap: 8px; font-size: 12px; color: #d7cabd; text-transform: uppercase; font-family: 'DM Mono', monospace; letter-spacing: 0.6px;">
                    Nama pelanggan
                    <input type="text" placeholder="Masukkan nama" style="background: #191919; border: 1px solid #2d2d2d; border-radius: 12px; color: #f7f3eb; min-height: 48px; padding: 0 14px; font: inherit; width: 100%; box-sizing: border-box;">
                </label>

                <div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; background: rgba(21,21,21,0.9); border: 1px solid #302d29; border-radius: 16px; padding: 6px; margin-bottom: 16px;">
                        <button type="button" @click="serviceType = 'barber'" :style="serviceType === 'barber' ? 'background: #e1bc55; color: #0b0b0b;' : 'background: transparent; color: #726b63;'" style="border: 0; border-radius: 12px; padding: 12px; font-weight: 600; font-size: 14px; display: flex; align-items: center; justify-content: center; gap: 8px; cursor: pointer;">
                            <span>✂</span> Barber
                        </button>
                        <button type="button" @click="serviceType = 'mua'" :style="serviceType === 'mua' ? 'background: #e1bc55; color: #0b0b0b;' : 'background: transparent; color: #726b63;'" style="border: 0; border-radius: 12px; padding: 12px; font-weight: 600; font-size: 14px; display: flex; align-items: center; justify-content: center; gap: 8px; cursor: pointer;">
                            <span>💄</span> MUA
                        </button>
                    </div>

                    <div style="display: grid; gap: 10px;">
                        <template x-for="service in services" :key="service.name">
                            <button type="button" @click="selectedService = service.name" :style="selectedService === service.name ? 'border-color: #e1bc55; background: rgba(225,188,85,0.1);' : 'border-color: #2d2d2d; background: #191919; color: #f7f3eb;'" style="display: flex; align-items: center; justify-content: space-between; gap: 10px; width: 100%; border: 1px solid #2d2d2d; border-radius: 12px; padding: 14px 16px; text-align: left; cursor: pointer;">
                                <span>
                                    <span x-text="service.name" style="display: block; font-weight: 600;"></span>
                                    <span x-text="serviceType === 'barber' ? 'Barber service' : 'MUA service'" style="font-size: 11px; color: #8b8177; text-transform: uppercase; letter-spacing: 0.5px;"></span>
                                </span>
                                <strong x-text="'Rp ' + Number(service.price).toLocaleString('id-ID')" style="color: #e1bc55; font-family: 'DM Mono', monospace; font-size: 13px;"></strong>
                            </button>
                        </template>
                    </div>
                </div>

                <div style="display: flex; gap: 12px; margin-top: 8px;">
                    <button type="button" @click="walkInOpen = false; selectedService = null" style="flex: 1; background: transparent; border: 1px solid #3a3a3a; border-radius: 12px; color: #f7f3eb; min-height: 48px; cursor: pointer; font-weight: 600;">Batal</button>
                    <button type="button" @click="developmentNoticeOpen = true" style="flex: 1; background: #e1bc55; border: 0; border-radius: 12px; color: #0b0b0b; min-height: 48px; cursor: pointer; font-weight: 700;">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="cashier-development-modal" x-show="developmentNoticeOpen" x-transition style="position: fixed; inset: 0; background: rgba(10, 10, 10, 0.7); display: flex; align-items: center; justify-content: center; padding: 20px; z-index: 60;">
        <div class="cashier-development-panel" style="width: min(420px, calc(100vw - 28px)); background: #121212; border: 1px solid #2f2f2f; border-radius: 26px; padding: 26px; box-shadow: 0 30px 90px rgba(0,0,0,0.45); color: #f7f3eb; box-sizing: border-box; margin: 0 auto; text-align: center;">
            <div style="font-family: 'DM Mono', monospace; font-size: 10px; letter-spacing: 1px; color: #c6b078; text-transform: uppercase; margin-bottom: 10px;">Informasi</div>
            <h3 style="margin: 0; font-size: 26px; font-family: 'Playfair Display', serif;">fitur masi dalam pengembangan</h3>
            <button type="button" @click="developmentNoticeOpen = false" style="width: 100%; background: #e1bc55; border: 0; border-radius: 12px; color: #0b0b0b; min-height: 48px; margin-top: 22px; cursor: pointer; font-weight: 700;">Tutup</button>
        </div>
    </div>

    <div class="cashier-tab-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; background: rgba(21, 21, 21, 0.85); border: 1px solid #302d29; border-radius: 16px; padding: 6px; margin-bottom: 22px; backdrop-filter: blur(10px);">
        <button type="button" @click="serviceType = 'barber'" :style="serviceType === 'barber' ? 'background: #e1bc55; color: #0b0b0b;' : 'background: transparent; color: #726b63;'" style="border: 0; border-radius: 12px; padding: 12px; font-weight: 600; font-size: 14px; display: flex; align-items: center; justify-content: center; gap: 8px; cursor: pointer; transition: all 0.2s;">
            <span>✂</span> Barber <span :style="serviceType === 'barber' ? 'background: rgba(0,0,0,0.15); color: #0b0b0b;' : 'background: #222; color: #726b63;'" style="border-radius: 20px; padding: 2px 8px; font-size: 11px;">{{ $bookings->filter(fn($b) => !str_contains(strtolower($b->service->name), 'makeup'))->count() }}</span>
        </button>
        <button type="button" @click="serviceType = 'mua'" :style="serviceType === 'mua' ? 'background: #e1bc55; color: #0b0b0b;' : 'background: transparent; color: #726b63;'" style="border: 0; border-radius: 12px; padding: 12px; font-weight: 600; font-size: 14px; display: flex; align-items: center; justify-content: center; gap: 8px; cursor: pointer; transition: all 0.2s;">
            <span>💄</span> MUA <span :style="serviceType === 'mua' ? 'background: rgba(0,0,0,0.15); color: #0b0b0b;' : 'background: #222; color: #726b63;'" style="border-radius: 20px; padding: 2px 8px; font-size: 11px;">{{ $bookings->filter(fn($b) => str_contains(strtolower($b->service->name), 'makeup'))->count() }}</span>
        </button>
    </div>

    <div class="cashier-search" style="background: rgba(21, 21, 21, 0.85); border: 1px solid #302d29; border-radius: 16px; display: flex; align-items: center; gap: 12px; padding: 0 16px; margin-bottom: 22px; backdrop-filter: blur(10px);">
        <span style="color: #726b63; font-size: 18px;">⌕</span>
        <input type="search" placeholder="Cari nama, kode, atau layanan..." style="background: transparent; border: 0; color: #f7f3eb; font: inherit; font-size: 14px; min-height: 50px; outline: none; width: 100%;">
    </div>

    <div class="cashier-status-filters" style="display: flex; gap: 10px; margin-bottom: 24px; overflow-x: auto; padding-bottom: 4px;">
        <button type="button" @click="statusFilter = 'all'" :style="statusFilter === 'all' ? 'background: #e1bc55; border: 0; border-radius: 20px; color: #0b0b0b; padding: 8px 16px; font-size: 13px; font-weight: 600; white-space: nowrap; cursor: pointer;' : 'background: rgba(21, 21, 21, 0.85); border: 1px solid #302d29; border-radius: 20px; color: #726b63; padding: 8px 16px; font-size: 13px; font-weight: 600; white-space: nowrap; cursor: pointer;'">Semua <span :style="statusFilter === 'all' ? 'background: rgba(0,0,0,0.15); color: #0b0b0b;' : 'background: #222; color: #f7f3eb;'" style="padding: 2px 8px; border-radius: 10px; font-size: 11px;">{{ $bookings->count() }}</span></button>
        <button type="button" @click="statusFilter = 'pending'" :style="statusFilter === 'pending' ? 'background: #e1bc55; border: 0; border-radius: 20px; color: #0b0b0b; padding: 8px 16px; font-size: 13px; font-weight: 600; white-space: nowrap; cursor: pointer;' : 'background: rgba(21, 21, 21, 0.85); border: 1px solid #302d29; border-radius: 20px; color: #726b63; padding: 8px 16px; font-size: 13px; font-weight: 600; white-space: nowrap; cursor: pointer;'">Menunggu <span :style="statusFilter === 'pending' ? 'background: rgba(0,0,0,0.15); color: #0b0b0b;' : 'background: #222; color: #f7f3eb;'" style="padding: 2px 8px; border-radius: 10px; font-size: 11px;">{{ $bookings->where('status', 'pending')->count() }}</span></button>
        <button type="button" @click="statusFilter = 'confirmed'" :style="statusFilter === 'confirmed' ? 'background: #e1bc55; border: 0; border-radius: 20px; color: #0b0b0b; padding: 8px 16px; font-size: 13px; font-weight: 600; white-space: nowrap; cursor: pointer;' : 'background: rgba(21, 21, 21, 0.85); border: 1px solid #302d29; border-radius: 20px; color: #726b63; padding: 8px 16px; font-size: 13px; font-weight: 600; white-space: nowrap; cursor: pointer;'">Proses <span :style="statusFilter === 'confirmed' ? 'background: rgba(0,0,0,0.15); color: #0b0b0b;' : 'background: #222; color: #f7f3eb;'" style="padding: 2px 8px; border-radius: 10px; font-size: 11px;">{{ $bookings->where('status', 'confirmed')->count() }}</span></button>
        <button type="button" @click="statusFilter = 'completed'" :style="statusFilter === 'completed' ? 'background: #e1bc55; border: 0; border-radius: 20px; color: #0b0b0b; padding: 8px 16px; font-size: 13px; font-weight: 600; white-space: nowrap; cursor: pointer;' : 'background: rgba(21, 21, 21, 0.85); border: 1px solid #302d29; border-radius: 20px; color: #726b63; padding: 8px 16px; font-size: 13px; font-weight: 600; white-space: nowrap; cursor: pointer;'">Selesai <span :style="statusFilter === 'completed' ? 'background: rgba(0,0,0,0.15); color: #0b0b0b;' : 'background: #222; color: #f7f3eb;'" style="padding: 2px 8px; border-radius: 10px; font-size: 11px;">{{ $bookings->where('status', 'completed')->count() }}</span></button>
    </div>

    <div style="display: grid; gap: 14px; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));">
        @forelse($bookings as $booking)
        <div class="cashier-booking-card" x-show="statusFilter === 'all' || '{{ $booking->status }}' === statusFilter" style="background: rgba(21, 21, 21, 0.85); border: 1px solid #302d29; border-radius: 16px; padding: 18px; backdrop-filter: blur(10px);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
                <div>
                    <strong style="font-size: 15px; color: #f7f3eb; display: block;">{{ $booking->user->name }}</strong>
                    <span style="font-family: 'DM Mono', monospace; font-size: 11px; color: #726b63;">GC-{{ strtoupper(substr(md5($booking->id), 0, 8)) }}</span>
                </div>
                <span style="font-family: 'DM Mono', monospace; font-size: 10px; text-transform: uppercase; padding: 5px 10px; border-radius: 8px; background: {{ $booking->status === 'pending' ? '#332b14; color: #e1bc55;' : ($booking->status === 'confirmed' ? '#143322; color: #55e188;' : '#142533; color: #55a8e1;') }};">{{ ucfirst($booking->status) }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center; font-size: 13px; border-top: 1px solid #262626; padding-top: 12px; margin-top: 12px;">
                <span style="color: #c4b9a0;">{{ str_contains(strtolower($booking->service->name), 'makeup') || str_contains(strtolower($booking->service->name), 'hair') ? '💄' : '✂' }} {{ $booking->service->name }}</span>
                <strong style="font-family: 'DM Mono', monospace; color: #e1bc55; font-size: 14px;">{{ $booking->appointment_at->format('H:i') }}</strong>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center; font-size: 12px; color: #726b63; margin-top: 8px;">
                <span>👤 Staff</span>
                <span style="font-weight: 600; color: #c4b9a0;">Rp {{ number_format($booking->service->price, 0, ',', '.') }}</span>
            </div>
            <div style="margin-top: 14px; padding-top: 10px; border-top: 1px solid #262626; display: flex; justify-content: flex-end;">
                <form method="POST" action="{{ route('bookings.status', $booking) }}">
                    @csrf @method('PATCH')
                    <select name="status" onchange="this.form.submit()" style="background: #222; border: 1px solid #302d29; color: #e1bc55; font-size: 12px; border-radius: 8px; padding: 6px 10px; cursor: pointer;">
                        <option value="pending" @selected($booking->status === 'pending')>Pending</option>
                        <option value="confirmed" @selected($booking->status === 'confirmed')>Confirmed</option>
                        <option value="completed" @selected($booking->status === 'completed')>Completed</option>
                        <option value="cancelled" @selected($booking->status === 'cancelled')>Cancelled</option>
                    </select>
                </form>
            </div>
        </div>
        @empty
        <div class="cashier-empty-state" style="grid-column: 1 / -1; text-align: center; color: #726b63; font-size: 14px; padding: 40px 0; background: rgba(21, 21, 21, 0.85); border: 1px solid #302d29; border-radius: 16px;">
            Belum ada booking masuk.
        </div>
        @endforelse
    </div>
</div>
@endif
@endsection

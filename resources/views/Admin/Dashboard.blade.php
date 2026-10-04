<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GLOWCUT - Dashboard Admin</title>
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts: DM Serif Display & Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/bootstrap.bundle.min.js"></script>

    <style>
        :root {
            --bg-dark: #08080b;
            --card-bg: #121217;
            --card-border: #202029;
            --card-hover: #181820;
            --gold-primary: #e5be58;
            --gold-secondary: #c99b33;
            --gold-subtle: rgba(229, 190, 88, 0.12);
            --gold-border: rgba(229, 190, 88, 0.3);
            --purple-btn: #6343ce;
            --purple-btn-hover: #7351df;
            --text-muted: #8c8c9a;
            --accent-green: #34d399;
            --accent-red: #f87171;
            --accent-cyan: #38bdf8;
            --accent-pink: #f472b6;
        }

        body {
            background-color: var(--bg-dark);
            color: #ffffff;
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        .font-serif {
            font-family: 'DM Serif Display', serif;
        }

        .app-container {
            width: 100%;
            max-width: 100%;
            min-height: 100vh;
            padding: 1.25rem 1rem 3rem 1rem;
            margin: 0 auto;
        }

        @media (min-width: 768px) {
            .app-container {
                max-width: 720px;
                padding: 1.75rem 1.5rem;
            }
        }

        @media (min-width: 992px) {
            .app-container {
                max-width: 980px;
                padding: 2rem;
            }
        }

        @media (min-width: 1200px) {
            .app-container {
                max-width: 1240px;
                padding: 2.25rem 2.5rem;
            }
        }

        .header-sub {
            font-size: 0.72rem;
            letter-spacing: 2.5px;
            color: var(--text-muted);
            font-weight: 700;
        }

        .header-title {
            font-size: 1.85rem;
            color: #ffffff;
            margin-bottom: 0.1rem;
            font-weight: 400;
        }

        .header-date {
            font-size: 0.82rem;
            color: var(--text-muted);
        }

        .btn-circle-icon {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background-color: #16161d;
            border: 1px solid #282832;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-circle-icon:hover {
            background-color: #22222c;
            color: var(--gold-primary);
            border-color: var(--gold-primary);
            transform: translateY(-1px);
        }

        .stat-card {
            background-color: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 1.15rem;
            padding: 1.15rem;
            height: 100%;
            position: relative;
            transition: transform 0.2s ease, border-color 0.2s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            border-color: rgba(229, 190, 88, 0.35);
        }

        .stat-card-gold {
            border-color: var(--gold-border);
            background: linear-gradient(145deg, #181510 0%, #121217 100%);
        }

        .icon-badge {
            width: 38px;
            height: 38px;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            background-color: rgba(255, 255, 255, 0.05);
        }

        .trend-indicator {
            font-size: 0.72rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.2rem;
        }

        .trend-up {
            color: var(--accent-green);
        }

        .trend-down {
            color: var(--accent-red);
        }

        .stat-val {
            font-size: 1.65rem;
            font-weight: 800;
            margin-top: 0.6rem;
            margin-bottom: 0.1rem;
            letter-spacing: -0.5px;
        }

        .val-gold { color: var(--gold-primary); }
        .val-cyan { color: var(--accent-cyan); }
        .val-purple { color: #a78bfa; }
        .val-pink { color: var(--accent-pink); }

        .stat-lbl {
            font-size: 0.82rem;
            font-weight: 700;
            color: #d1d1dc;
            margin-bottom: 0.15rem;
        }

        .stat-subtext {
            font-size: 0.73rem;
            color: var(--text-muted);
        }

        .btn-action-purple {
            background: linear-gradient(135deg, #6d4be0 0%, #5235b8 100%);
            color: #ffffff;
            font-weight: 700;
            font-size: 0.95rem;
            border: none;
            border-radius: 1rem;
            padding: 0.95rem 1.25rem;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            box-shadow: 0 4px 18px rgba(99, 67, 206, 0.25);
            transition: all 0.2s ease;
        }

        .btn-action-purple:hover {
            background: linear-gradient(135deg, #7b58f0 0%, #5d3dc9 100%);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 22px rgba(99, 67, 206, 0.35);
        }

        .btn-action-gold {
            background: linear-gradient(135deg, #ebd178 0%, #e5be58 50%, #c99b33 100%);
            color: #0e0e11;
            font-weight: 800;
            font-size: 0.95rem;
            border: none;
            border-radius: 1rem;
            padding: 0.95rem 1.25rem;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            box-shadow: 0 4px 18px rgba(229, 190, 88, 0.25);
            transition: all 0.2s ease;
        }

        .btn-action-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 22px rgba(229, 190, 88, 0.35);
            color: #000;
        }

        .revenue-chart-card {
            background-color: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 1.15rem;
            padding: 1.25rem 1.35rem;
        }

        .chart-day-col {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            flex: 1;
        }

        .chart-bar-bg {
            width: 100%;
            max-width: 28px;
            height: 90px;
            background-color: #1b1b24;
            border-radius: 0.5rem;
            display: flex;
            align-items: flex-end;
            overflow: hidden;
            padding: 2px;
        }

        .chart-bar-fill {
            width: 100%;
            background-color: #31313e;
            border-radius: 0.35rem;
            transition: height 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .chart-day-col.active .chart-bar-fill {
            background: linear-gradient(180deg, #f0d479 0%, #c99b33 100%);
            box-shadow: 0 0 12px rgba(229, 190, 88, 0.4);
        }

        .chart-day-label {
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--text-muted);
        }

        .chart-day-col.active .chart-day-label {
            color: var(--gold-primary);
            font-weight: 800;
        }

        .employee-card {
            background-color: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 1rem;
            padding: 0.95rem 1.15rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.2s ease;
        }

        .employee-card:hover {
            border-color: rgba(229, 190, 88, 0.3);
            background-color: var(--card-hover);
        }

        .avatar-wrapper {
            position: relative;
            width: 48px;
            height: 48px;
            flex-shrink: 0;
        }

        .avatar-img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid #333342;
        }

        .status-dot-active {
            position: absolute;
            bottom: 1px;
            right: 1px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #22c55e;
            border: 2px solid var(--card-bg);
        }

        .status-dot-off {
            position: absolute;
            bottom: 1px;
            right: 1px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #6b7280;
            border: 2px solid var(--card-bg);
        }

        .emp-name {
            font-weight: 800;
            font-size: 0.95rem;
            color: #ffffff;
            margin-bottom: 0.1rem;
        }

        .emp-role-barber {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--gold-primary);
        }

        .emp-role-mua {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--accent-pink);
        }

        .emp-stats-num {
            font-weight: 800;
            font-size: 0.9rem;
            color: #d1d1dc;
        }

        .emp-status-badge {
            font-size: 0.7rem;
            font-weight: 700;
            color: #4ade80;
        }

        /* Modal styling */
        .custom-modal-content {
            background-color: #141419;
            border: 1px solid var(--card-border);
            border-radius: 1.25rem;
        }

        .form-dark-input {
            background-color: #1a1a22;
            border: 1px solid #2a2a36;
            color: #ffffff;
            border-radius: 0.75rem;
            padding: 0.7rem 1rem;
        }

        .form-dark-input:focus {
            background-color: #1e1e28;
            border-color: var(--gold-primary);
            box-shadow: 0 0 0 0.25rem rgba(229, 190, 88, 0.15);
            color: #fff;
        }

        .employee-modal-dialog {
            width: min(560px, calc(100% - 1rem));
        }

        .employee-modal-content {
            max-height: min(90vh, 820px);
            overflow: hidden;
            border: 1px solid #34313d;
            border-radius: 0.9rem;
            background-color: #17171c !important;
            color: #f5f5f6;
        }

        .employee-modal-body {
            overflow-y: auto;
        }

        .employee-account-list {
            overflow: hidden;
            border: 1px solid #302e38;
            border-radius: 0.8rem;
        }

        .employee-account-row {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            padding: 0.7rem 0.8rem;
        }

        .employee-account-row + .employee-account-row {
            border-top: 1px solid #302e38;
        }

        .employee-avatar-initial {
            display: grid;
            width: 2.25rem;
            height: 2.25rem;
            flex: 0 0 auto;
            place-items: center;
            border-radius: 50%;
            background: #382957;
            color: #c7a6ff;
            font-weight: 800;
        }

        .employee-account-details {
            min-width: 0;
            flex: 1;
        }

        .employee-account-name {
            overflow: hidden;
            color: #f5f5f6;
            font-size: 0.82rem;
            font-weight: 700;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .employee-account-meta {
            color: #92909b;
            font-size: 0.68rem;
        }

        .employee-account-status {
            width: 0.45rem;
            height: 0.45rem;
            flex: 0 0 auto;
            border-radius: 50%;
            background: #43d59a;
        }

        .employee-add-toggle {
            width: 100%;
            border: 1px solid #382957;
            border-radius: 0.55rem;
            background: #292231;
            color: #c7a6ff;
            font-weight: 800;
            padding: 0.72rem 1rem;
        }

        .employee-add-toggle:hover,
        .employee-add-toggle:focus-visible {
            border-color: #7252a8;
            background: #33283f;
            color: #e0d1ff;
        }

        .employee-create-form {
            border-top: 1px solid #302e38;
        }

        .employee-form-label {
            color: #b9b6c2;
            font-size: 0.65rem;
            font-weight: 800;
            text-transform: uppercase;
        }

        @media (max-width: 575.98px) {
            .employee-modal-dialog {
                width: 100%;
                margin: 0;
            }

            .employee-modal-content {
                max-height: 100vh;
                min-height: 100vh;
                border: 0;
                border-radius: 0;
            }
        }

        .report-modal-dialog {
            max-width: 760px;
        }

        .report-modal-content {
            max-height: min(86vh, 900px);
            background-color: #141419 !important;
            color: #ffffff;
        }

        .report-total {
            background: rgba(229, 190, 88, 0.1);
            border: 1px solid var(--gold-border);
            border-radius: 0.9rem;
        }

        .report-filters .form-dark-input {
            min-width: 180px;
            padding-block: 0.55rem;
        }

        .report-category-btn {
            background: #1a1a22;
            border: 1px solid #2a2a36;
            color: var(--text-muted);
            font-size: 0.8rem;
            font-weight: 700;
            padding: 0.55rem 0.9rem;
        }

        .report-category-btn:hover,
        .report-category-btn.active {
            background: var(--purple-btn);
            border-color: var(--purple-btn);
            color: #fff;
        }

        .report-list {
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 0.85rem;
        }

        .report-list-heading,
        .report-transaction {
            display: grid;
            grid-template-columns: 76px 1fr 88px;
            gap: 0.75rem;
            align-items: center;
        }

        .report-list-heading {
            padding: 0.65rem 0.85rem;
            background: var(--surface-2);
            color: var(--text-muted);
            font-size: 0.62rem;
            font-weight: 800;
            text-transform: uppercase;
        }

        .report-transaction {
            min-height: 70px;
            padding: 0.65rem 0.85rem;
            border-top: 1px solid var(--border);
        }

        .report-date-time {
            color: var(--text-muted);
            font-size: 0.68rem;
            line-height: 1.5;
        }

        .report-service-name {
            overflow: hidden;
            color: var(--text);
            font-size: 0.82rem;
            font-weight: 700;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .report-service-meta {
            color: var(--text-muted);
            font-size: 0.66rem;
        }

        .report-type-badge {
            display: inline-block;
            margin-right: 0.3rem;
            border-radius: 0.25rem;
            background: rgba(99, 67, 206, 0.2);
            color: #b6a2ff;
            font-size: 0.58rem;
            font-weight: 800;
            padding: 0.12rem 0.32rem;
        }

        .report-type-badge.walkin {
            background: rgba(52, 211, 153, 0.14);
            color: #6ee7b7;
        }

        .report-amount {
            color: var(--gold-primary);
            font-size: 0.76rem;
            font-weight: 800;
            text-align: right;
            white-space: nowrap;
        }

        @media (max-width: 575.98px) {
            .report-modal-content {
                max-height: 100vh;
                border: 0;
                border-radius: 0;
            }

            .report-filters .form-dark-input {
                flex: 1 1 100%;
                width: 100%;
            }

            .report-category-filter {
                display: flex;
                width: 100%;
            }

            .report-category-btn {
                flex: 1;
                padding-inline: 0.45rem;
            }

            .report-list-heading,
            .report-transaction {
                grid-template-columns: 54px minmax(0, 1fr) 66px;
                gap: 0.45rem;
                padding-inline: 0.65rem;
            }

            .report-service-name {
                font-size: 0.74rem;
            }

            .report-amount {
                font-size: 0.68rem;
            }
        }
    </style>

    <style>
        html {
            color-scheme: dark;
        }

        html[data-theme="light"] {
            color-scheme: light;
            --bg-app: #f3f6fb;
            --surface: #ffffff;
            --surface-2: #edf3fa;
            --surface-3: #e4ebf6;
            --text: #111827;
            --text-muted: #5f6c7a;
            --border: #dfe7f1;
            --gold-primary: #c8901a;
            --gold-secondary: #b88318;
            --gold-border: rgba(200, 144, 26, 0.28);
            --shadow: rgba(15, 23, 42, 0.08);
        }

        html[data-theme="dark"] {
            color-scheme: dark;
            --bg-app: #08080b;
            --surface: #121217;
            --surface-2: #171720;
            --surface-3: #1d1d29;
            --text: #ffffff;
            --text-muted: #8c8c9a;
            --border: #202029;
            --gold-primary: #e5be58;
            --gold-secondary: #c99b33;
            --gold-border: rgba(229, 190, 88, 0.3);
            --shadow: rgba(0,0,0,0.7);
        }

        body {
            background: var(--bg-app);
            color: var(--text);
            transition: background 0.25s ease, color 0.25s ease;
        }

        .app-container,
        .stat-card,
        .revenue-chart-card,
        .employee-card,
        .custom-modal-content,
        .form-dark-input,
        .btn-circle-icon,
        .booking-card,
        .category-switcher,
        .search-box,
        .search-input,
        .filter-pills-container,
        .pill-btn,
        .card,
        .navbar,
        .btn-action-gold {
            transition: all 0.25s ease;
        }

        .app-container {
            background-color: var(--bg-app);
        }

        .header-title,
        .emp-name,
        .cust-name,
        .stat-lbl,
        .chart-day-label,
        .text-white,
        .header-date,
        .modal-title {
            color: var(--text) !important;
        }

        .stat-card,
        .revenue-chart-card,
        .employee-card,
        .custom-modal-content,
        .booking-card,
        .card,
        .search-input,
        .filter-pills-container,
        .pill-btn,
        .btn-circle-icon,
        .navbar {
            background-color: var(--surface);
            border-color: var(--border);
            color: var(--text);
        }

        .stat-card,
        .revenue-chart-card,
        .employee-card,
        .booking-card,
        .custom-modal-content,
        .btn-circle-icon {
            box-shadow: 0 8px 18px var(--shadow);
        }

        .search-input,
        .form-dark-input {
            background-color: var(--surface-2);
            color: var(--text);
            border-color: var(--border);
        }

        .search-input::placeholder,
        .form-label,
        .card-detail-item,
        .small,
        .header-sub,
        .stats-sub,
        .text-muted {
            color: var(--text-muted) !important;
        }

        .chart-bar-bg {
            background-color: var(--surface-2);
        }

        .chart-bar-fill {
            background: linear-gradient(180deg, rgba(229,190,88,0.7), var(--gold-primary));
        }

        .theme-toggle-btn {
            position: fixed;
            right: 20px;
            bottom: 20px;
            z-index: 999;
            width: 52px;
            height: 52px;
            border-radius: 50%;
            border: 1px solid var(--border);
            background: var(--surface);
            color: var(--text);
            box-shadow: 0 8px 20px var(--shadow);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="app-container">
        
        <!-- Top Navigation / Header -->
        <header class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <div class="header-sub">GLOWCUT &nbsp;•&nbsp; ADMIN PANEL</div>
                <h1 class="header-title font-serif">Dashboard Admin</h1>
                <div class="header-date">Kamis, 24 September 2026</div>
            </div>
            <div class="d-flex gap-2">
                <button class="btn-circle-icon" title="Notifikasi" onclick="showNotification()">
                    <i class="fa-regular fa-bell"></i>
                </button>
                <a href="/logout" class="btn-circle-icon" title="Keluar" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </a>
            </div>
        </header>

        <section class="row g-2.5 mb-3">
            <!-- Stat 1: Total Pendapatan -->
            <div class="col-6 col-lg-3">
                <div class="stat-card stat-card-gold">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="icon-badge">💰</div>
                        <div class="trend-indicator trend-up">
                            <i class="fa-solid fa-caret-up"></i>
                        </div>
                    </div>
                    <div>
                        <div class="stat-val val-gold">Rp 18.4jt</div>
                        <div class="stat-lbl">Total Pendapatan</div>
                        <div class="stat-subtext">+12% vs minggu lalu</div>
                    </div>
                </div>
            </div>

            <!-- Stat 2: Booking Hari Ini -->
            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="icon-badge">📅</div>
                        <div class="trend-indicator trend-up">
                            <i class="fa-solid fa-caret-up"></i>
                        </div>
                    </div>
                    <div>
                        <div class="stat-val val-cyan">24</div>
                        <div class="stat-lbl">Booking Hari Ini</div>
                        <div class="stat-subtext">6 menunggu · 3 proses</div>
                    </div>
                </div>
            </div>

            <!-- Stat 3: Walk-in Hari Ini -->
            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="icon-badge">🚶</div>
                        <div class="trend-indicator trend-down">
                            <i class="fa-solid fa-caret-down"></i>
                        </div>
                    </div>
                    <div>
                        <div class="stat-val val-purple">9</div>
                        <div class="stat-lbl">Walk-in Hari Ini</div>
                        <div class="stat-subtext">Rp 1.2jt dari walk-in</div>
                    </div>
                </div>
            </div>

            <!-- Stat 4: Total Karyawan -->
            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="icon-badge">👥</div>
                        <div class="trend-indicator trend-up">
                            <i class="fa-solid fa-caret-up"></i>
                        </div>
                    </div>
                    <div>
                        <div class="stat-val val-pink">8</div>
                        <div class="stat-lbl">Total Karyawan</div>
                        <div class="stat-subtext">6 aktif hari ini</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="row g-2.5 mb-3">
            <div class="col-12 col-md-6">
                <button type="button" class="btn-action-purple" onclick="openEmployeeModal()">
                    <i class="fa-solid fa-user-group fs-5"></i>
                    <span>Kelola Karyawan</span>
                </button>
            </div>
            <div class="col-12 col-md-6">
                <button type="button" class="btn-action-gold" onclick="openReportModal()">
                    <i class="fa-solid fa-sack-dollar fs-5"></i>
                    <span>Laporan Pendapatan</span>
                </button>
            </div>
        </section>

        <section class="revenue-chart-card mb-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="h6 fw-bold text-white mb-0">Pendapatan Minggu Ini</h2>
                <div class="fw-extrabold text-gold fs-6">Rp 5.3jt</div>
            </div>

            <!-- Bar Chart Display -->
            <div class="d-flex justify-content-between align-items-end pt-2 pb-1 px-1">
                <div class="chart-day-col">
                    <div class="chart-bar-bg">
                        <div class="chart-bar-fill" style="height: 35%;"></div>
                    </div>
                    <span class="chart-day-label">Sen</span>
                </div>
                <div class="chart-day-col">
                    <div class="chart-bar-bg">
                        <div class="chart-bar-fill" style="height: 50%;"></div>
                    </div>
                    <span class="chart-day-label">Sel</span>
                </div>
                <div class="chart-day-col">
                    <div class="chart-bar-bg">
                        <div class="chart-bar-fill" style="height: 65%;"></div>
                    </div>
                    <span class="chart-day-label">Rab</span>
                </div>
                <!-- Active Day (Kamis) -->
                <div class="chart-day-col active">
                    <div class="chart-bar-bg">
                        <div class="chart-bar-fill" style="height: 90%;"></div>
                    </div>
                    <span class="chart-day-label">Kam</span>
                </div>
                <div class="chart-day-col">
                    <div class="chart-bar-bg">
                        <div class="chart-bar-fill" style="height: 40%;"></div>
                    </div>
                    <span class="chart-day-label">Jum</span>
                </div>
                <div class="chart-day-col">
                    <div class="chart-bar-bg">
                        <div class="chart-bar-fill" style="height: 75%;"></div>
                    </div>
                    <span class="chart-day-label">Sab</span>
                </div>
                <div class="chart-day-col">
                    <div class="chart-bar-bg">
                        <div class="chart-bar-fill" style="height: 60%;"></div>
                    </div>
                    <span class="chart-day-label">Min</span>
                </div>
            </div>
        </section>

        <section>
            <div class="d-flex justify-content-between align-items-center mb-2.5">
                <h2 class="h6 fw-bold text-white mb-0">Daftar Karyawan</h2>
                <a href="#" class="text-decoration-none small text-purple fw-bold" style="color: #a78bfa;" data-bs-toggle="modal" data-bs-target="#employeeModal">
                    Kelola
                </a>
            </div>

            <div class="d-flex flex-column gap-2" id="employeeListContainer">
                
                <!-- Staff 1 -->
                <div class="employee-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar-wrapper">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&auto=format&fit=crop&q=80" alt="Budi Santoso" class="avatar-img">
                            <span class="status-dot-active"></span>
                        </div>
                        <div>
                            <div class="emp-name">Budi Santoso</div>
                            <div class="emp-role-barber">Senior Barber</div>
                        </div>
                    </div>
                    <div class="text-end">
                        <div class="emp-stats-num">28 layanan</div>
                        <div class="emp-status-badge">Aktif</div>
                    </div>
                </div>

                <!-- Staff 2 -->
                <div class="employee-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar-wrapper">
                            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&auto=format&fit=crop&q=80" alt="Rina Andini" class="avatar-img">
                            <span class="status-dot-active"></span>
                        </div>
                        <div>
                            <div class="emp-name">Rina Andini</div>
                            <div class="emp-role-mua">MUA Artist</div>
                        </div>
                    </div>
                    <div class="text-end">
                        <div class="emp-stats-num">18 layanan</div>
                        <div class="emp-status-badge">Aktif</div>
                    </div>
                </div>

                <!-- Staff 3 (Desktop/Laptop extra item) -->
                <div class="employee-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar-wrapper">
                            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&auto=format&fit=crop&q=80" alt="Dimas Rizky" class="avatar-img">
                            <span class="status-dot-active"></span>
                        </div>
                        <div>
                            <div class="emp-name">Dimas Rizky</div>
                            <div class="emp-role-barber">Junior Barber</div>
                        </div>
                    </div>
                    <div class="text-end">
                        <div class="emp-stats-num">14 layanan</div>
                        <div class="emp-status-badge">Aktif</div>
                    </div>
                </div>

            </div>
        </section>

    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1090;">
        <div id="actionToast" class="toast align-items-center text-bg-success border-0 rounded-3 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body d-flex align-items-center gap-2">
                    <i class="fa-solid fa-circle-check fs-5"></i>
                    <div>
                        <strong class="d-block" id="toastTitle">Berhasil!</strong>
                        <span class="small" id="toastDesc">Aksi berhasil diperbarui.</span>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <!-- Modal Kelola Karyawan -->
    <div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable employee-modal-dialog">
            <div class="modal-content custom-modal-content employee-modal-content">
                <div class="modal-header border-bottom border-secondary border-opacity-25 px-4 pt-4 pb-3">
                    <div>
                        <div class="header-sub mb-1" style="color: #a78bfa;">ADMIN PANEL</div>
                        <h5 class="modal-title font-serif text-white fs-4 mb-0" id="employeeModalLabel">Kelola Karyawan</h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white" onclick="closeEmployeeModal()" aria-label="Close"></button>
                </div>
                <div class="modal-body employee-modal-body px-4 pt-3 pb-4">
                    <div class="employee-account-list mb-3" id="employeeAccountList" aria-label="Daftar karyawan aktif">
                        <div class="employee-account-row">
                            <span class="employee-avatar-initial" aria-hidden="true">B</span>
                            <div class="employee-account-details">
                                <div class="employee-account-name">Budi Santoso</div>
                                <div class="employee-account-meta">Senior Barber</div>
                            </div>
                            <span class="employee-account-status" role="img" aria-label="Aktif"></span>
                        </div>
                        <div class="employee-account-row">
                            <span class="employee-avatar-initial" aria-hidden="true">R</span>
                            <div class="employee-account-details">
                                <div class="employee-account-name">Rina Andini</div>
                                <div class="employee-account-meta">MUA Artist</div>
                            </div>
                            <span class="employee-account-status" role="img" aria-label="Aktif"></span>
                        </div>
                        <div class="employee-account-row">
                            <span class="employee-avatar-initial" aria-hidden="true">D</span>
                            <div class="employee-account-details">
                                <div class="employee-account-name">Dimas Rizky</div>
                                <div class="employee-account-meta">Junior Barber</div>
                            </div>
                            <span class="employee-account-status" role="img" aria-label="Aktif"></span>
                        </div>
                    </div>

                    <button type="button" class="employee-add-toggle mb-3" id="employeeFormToggle" aria-expanded="true" aria-controls="employeeCreateForm" onclick="toggleEmployeeForm()">
                        <i class="fa-solid fa-plus me-2" aria-hidden="true"></i><span id="employeeFormToggleText">Tambah Karyawan</span>
                    </button>

                    <form class="employee-create-form pt-3" id="employeeCreateForm" onsubmit="handleAddEmployee(event)">
                        <div class="mb-3">
                            <label for="newEmpName" class="form-label employee-form-label">Nama Lengkap</label>
                            <input type="text" id="newEmpName" required class="form-control form-dark-input" placeholder="Contoh: Budi Santoso" autocomplete="name">
                        </div>
                        <div class="mb-3">
                            <label for="newEmpUsername" class="form-label employee-form-label">Username</label>
                            <input type="text" id="newEmpUsername" required class="form-control form-dark-input" placeholder="Contoh: budi.santoso" autocomplete="username">
                        </div>
                        <div class="mb-3">
                            <label for="newEmpPassword" class="form-label employee-form-label">Password</label>
                            <input type="password" id="newEmpPassword" required minlength="8" class="form-control form-dark-input" placeholder="Minimal 8 karakter" autocomplete="new-password">
                        </div>
                        <div class="mb-3">
                            <label for="newEmpPasswordConfirm" class="form-label employee-form-label">Ulangi Password</label>
                            <input type="password" id="newEmpPasswordConfirm" required minlength="8" class="form-control form-dark-input" placeholder="Ulangi password" autocomplete="new-password">
                        </div>
                        <div class="mb-3">
                            <label for="newEmpRole" class="form-label employee-form-label">Peran / Posisi</label>
                            <select id="newEmpRole" class="form-select form-dark-input">
                                <option value="Senior Barber">Senior Barber</option>
                                <option value="Junior Barber">Junior Barber</option>
                                <option value="MUA Artist">MUA Artist</option>
                                <option value="Hair Stylist">Hair Stylist</option>
                            </select>
                        </div>
                        <div class="small text-danger mb-3" id="employeeFormError" role="alert"></div>
                        <button type="submit" class="btn btn-action-purple w-100">
                            <i class="fa-solid fa-plus me-1" aria-hidden="true"></i>Buat Akun Karyawan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Laporan Pendapatan -->
    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg modal-fullscreen-sm-down report-modal-dialog">
            <div class="modal-content custom-modal-content report-modal-content">
                <div class="modal-header border-bottom border-secondary border-opacity-25 px-4 pt-4 pb-3">
                    <div>
                        <div class="header-sub mb-1">ADMIN</div>
                        <h5 class="modal-title font-serif text-white fs-4 mb-0" id="reportModalLabel">Laporan Pendapatan</h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white" onclick="closeReportModal()" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3 p-md-4">
                    <div class="report-total p-3 mb-3">
                        <div class="small text-muted mb-1">Pendapatan Bulan Ini</div>
                        <div class="h3 fw-extrabold text-gold mb-2">Rp 74.800.000</div>
                        <div class="d-flex flex-wrap gap-3 small">
                            <span class="text-muted">Barbershop <strong class="text-white ms-1">Rp 48.200.000</strong></span>
                            <span class="text-muted">MUA <strong class="text-white ms-1">Rp 26.600.000</strong></span>
                        </div>
                    </div>

                    <div class="report-filters d-flex flex-wrap align-items-center gap-2 mb-3">
                        <label class="visually-hidden" for="reportDateFilter">Filter tanggal</label>
                        <select id="reportDateFilter" class="form-select form-dark-input" onchange="filterReportTransactions()">
                            <option value="all">Semua Tanggal</option>
                            <option value="2026-09-15">15 Sep</option>
                            <option value="2026-09-14">14 Sep</option>
                        </select>
                        <div class="btn-group report-category-filter" role="group" aria-label="Filter kategori laporan">
                            <button type="button" class="btn report-category-btn active" aria-pressed="true" onclick="filterReportTransactions('all')">Semua</button>
                            <button type="button" class="btn report-category-btn" aria-pressed="false" onclick="filterReportTransactions('barber')">Barber</button>
                            <button type="button" class="btn report-category-btn" aria-pressed="false" onclick="filterReportTransactions('mua')">MUA</button>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="text-white fw-bold mb-0">Tabel Pemasukan</h6>
                        <span class="small text-muted" id="reportTransactionCount">8 transaksi pratinjau</span>
                    </div>
                    <div class="report-list" id="reportTransactionList">
                        <div class="report-list-heading">
                            <span>Tanggal</span>
                            <span>Layanan</span>
                            <span class="text-end">Nominal</span>
                        </div>
                        <article class="report-transaction" data-category="barber" data-date="2026-09-15">
                            <div class="report-date-time">15 Sep<br>10:15</div>
                            <div class="min-w-0"><div class="report-service-name"><span class="report-type-badge">Booking</span>Haircut Classic</div><div class="report-service-meta">Budi Santoso</div></div>
                            <div class="report-amount">Rp 82.000</div>
                        </article>
                        <article class="report-transaction" data-category="barber" data-date="2026-09-15">
                            <div class="report-date-time">15 Sep<br>10:45</div>
                            <div class="min-w-0"><div class="report-service-name"><span class="report-type-badge walkin">Walk-in</span>Shaving Premium</div><div class="report-service-meta">Wahyu · Dimas R.</div></div>
                            <div class="report-amount">Rp 55.000</div>
                        </article>
                        <article class="report-transaction" data-category="mua" data-date="2026-09-15">
                            <div class="report-date-time">15 Sep<br>11:30</div>
                            <div class="min-w-0"><div class="report-service-name"><span class="report-type-badge">Booking</span>MUA Natural Wisuda</div><div class="report-service-meta">Sari D. · Rina A.</div></div>
                            <div class="report-amount">Rp 385.000</div>
                        </article>
                        <article class="report-transaction" data-category="barber" data-date="2026-09-15">
                            <div class="report-date-time">15 Sep<br>12:00</div>
                            <div class="min-w-0"><div class="report-service-name"><span class="report-type-badge walkin">Walk-in</span>Fade Cut</div><div class="report-service-meta">Wahyu · Budi S.</div></div>
                            <div class="report-amount">Rp 99.000</div>
                        </article>
                        <article class="report-transaction" data-category="mua" data-date="2026-09-15">
                            <div class="report-date-time">15 Sep<br>13:15</div>
                            <div class="min-w-0"><div class="report-service-name"><span class="report-type-badge">Booking</span>Paket Hijab + Makeup</div><div class="report-service-meta">Nadia P. · Rina A.</div></div>
                            <div class="report-amount">Rp 495.000</div>
                        </article>
                        <article class="report-transaction" data-category="barber" data-date="2026-09-15">
                            <div class="report-date-time">15 Sep<br>14:00</div>
                            <div class="min-w-0"><div class="report-service-name"><span class="report-type-badge">Booking</span>Hair Coloring</div><div class="report-service-meta">Fajar A. · Dimas R.</div></div>
                            <div class="report-amount">Rp 275.000</div>
                        </article>
                        <article class="report-transaction" data-category="barber" data-date="2026-09-15">
                            <div class="report-date-time">15 Sep<br>14:30</div>
                            <div class="min-w-0"><div class="report-service-name"><span class="report-type-badge walkin">Walk-in</span>Creambath</div><div class="report-service-meta">Wahyu · Yoga P.</div></div>
                            <div class="report-amount">Rp 61.000</div>
                        </article>
                        <article class="report-transaction" data-category="barber" data-date="2026-09-14">
                            <div class="report-date-time">14 Sep<br>16:20</div>
                            <div class="min-w-0"><div class="report-service-name"><span class="report-type-badge">Booking</span>Haircut &amp; Beard Trim</div><div class="report-service-meta">Rizky M. · Budi S.</div></div>
                            <div class="report-amount">Rp 120.000</div>
                        </article>
                    </div>
                    <div class="d-none text-center text-muted small py-4" id="reportEmptyState">Tidak ada transaksi untuk filter ini.</div>
                    <div class="small text-muted mt-2">Data contoh untuk pratinjau laporan.</div>
                    <button class="btn btn-action-gold" onclick="downloadReport()">
                        <i class="fa-solid fa-file-arrow-down"></i> Unduh Laporan PDF
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content custom-modal-content text-center p-3">
                <div class="modal-body">
                    <i class="fa-solid fa-right-from-bracket text-gold fs-1 mb-3"></i>
                    <h5 class="fw-bold text-white mb-2">Keluar dari Admin?</h5>
                    <p class="small text-muted mb-4">Anda harus masuk kembali untuk mengelola sistem.</p>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-secondary w-50" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-action-gold w-50" onclick="triggerToast('Keluar', 'Anda telah berhasil keluar.')" data-bs-dismiss="modal">Keluar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function triggerToast(title, desc) {
            document.getElementById('toastTitle').innerText = title;
            document.getElementById('toastDesc').innerText = desc;
            
            const toastEl = document.getElementById('actionToast');
            if (toastEl && window.bootstrap && window.bootstrap.Toast) {
                const toast = bootstrap.Toast.getOrCreateInstance(toastEl);
                toast.show();
            }
        }

        function showNotification() {
            triggerToast('Notifikasi', '3 pesanan booking baru membutuhkan konfirmasi.');
        }

        function openEmployeeModal() {
            const modalEl = document.getElementById('employeeModal');
            const backdrop = document.createElement('div');

            backdrop.id = 'employeeModalBackdrop';
            backdrop.className = 'modal-backdrop fade show';
            backdrop.addEventListener('click', closeEmployeeModal, { once: true });
            document.body.appendChild(backdrop);

            modalEl.style.display = 'block';
            modalEl.classList.add('show');
            modalEl.setAttribute('aria-hidden', 'false');
            modalEl.setAttribute('aria-modal', 'true');
            modalEl.setAttribute('role', 'dialog');
            document.body.classList.add('modal-open');
            document.addEventListener('keydown', handleEmployeeModalKeydown);
            modalEl.querySelector('.btn-close').focus();
        }

        function closeEmployeeModal() {
            const modalEl = document.getElementById('employeeModal');

            modalEl.style.display = 'none';
            modalEl.classList.remove('show');
            modalEl.setAttribute('aria-hidden', 'true');
            modalEl.removeAttribute('aria-modal');
            modalEl.removeAttribute('role');
            document.body.classList.remove('modal-open');
            document.removeEventListener('keydown', handleEmployeeModalKeydown);
            document.getElementById('employeeModalBackdrop')?.remove();
        }

        function handleEmployeeModalKeydown(event) {
            if (event.key === 'Escape') {
                closeEmployeeModal();
            }
        }

        function toggleEmployeeForm() {
            const form = document.getElementById('employeeCreateForm');
            const toggle = document.getElementById('employeeFormToggle');
            const isExpanded = toggle.getAttribute('aria-expanded') === 'true';

            form.hidden = isExpanded;
            toggle.setAttribute('aria-expanded', String(!isExpanded));
            document.getElementById('employeeFormToggleText').textContent = isExpanded ? 'Tambah Karyawan' : 'Tutup Form';
        }

        function openReportModal() {
            const modalEl = document.getElementById('reportModal');
            const backdrop = document.createElement('div');

            backdrop.id = 'reportModalBackdrop';
            backdrop.className = 'modal-backdrop fade show';
            backdrop.addEventListener('click', closeReportModal, { once: true });
            document.body.appendChild(backdrop);

            modalEl.style.display = 'block';
            modalEl.classList.add('show');
            modalEl.setAttribute('aria-hidden', 'false');
            modalEl.setAttribute('aria-modal', 'true');
            modalEl.setAttribute('role', 'dialog');
            document.body.classList.add('modal-open');
            document.addEventListener('keydown', handleReportModalKeydown);
            modalEl.querySelector('.btn-close').focus();
        }

        function closeReportModal() {
            const modalEl = document.getElementById('reportModal');
            const backdrop = document.getElementById('reportModalBackdrop');

            modalEl.style.display = 'none';
            modalEl.classList.remove('show');
            modalEl.setAttribute('aria-hidden', 'true');
            modalEl.removeAttribute('aria-modal');
            modalEl.removeAttribute('role');
            document.body.classList.remove('modal-open');
            document.removeEventListener('keydown', handleReportModalKeydown);
            backdrop?.remove();
        }

        function handleReportModalKeydown(event) {
            if (event.key === 'Escape') {
                closeReportModal();
            }
        }

        let reportCategoryFilter = 'all';

        function filterReportTransactions(category) {
            if (category) {
                reportCategoryFilter = category;
            }

            document.querySelectorAll('.report-category-btn').forEach(button => {
                const isActive = button.textContent.trim().toLowerCase() === reportCategoryFilter;
                button.classList.toggle('active', isActive);
                button.setAttribute('aria-pressed', String(isActive));
            });

            const selectedDate = document.getElementById('reportDateFilter').value;
            const transactions = document.querySelectorAll('.report-transaction');
            let visibleTransactions = 0;

            transactions.forEach(transaction => {
                const matchesCategory = reportCategoryFilter === 'all' || transaction.dataset.category === reportCategoryFilter;
                const matchesDate = selectedDate === 'all' || transaction.dataset.date === selectedDate;
                const isVisible = matchesCategory && matchesDate;

                transaction.classList.toggle('d-none', !isVisible);
                if (isVisible) {
                    visibleTransactions++;
                }
            });

            document.getElementById('reportTransactionCount').textContent = `${visibleTransactions} transaksi pratinjau`;
            document.getElementById('reportEmptyState').classList.toggle('d-none', visibleTransactions > 0);
        }

        function downloadReport() {
            closeReportModal();
            triggerToast('Unduh Berhasil', 'Laporan pendapatan PDF sedang diunduh.');
        }

        function handleAddEmployee(e) {
            e.preventDefault();
            const name = document.getElementById('newEmpName').value.trim();
            const username = document.getElementById('newEmpUsername').value.trim();
            const password = document.getElementById('newEmpPassword').value;
            const passwordConfirm = document.getElementById('newEmpPasswordConfirm').value;
            const role = document.getElementById('newEmpRole').value;
            const feedback = document.getElementById('employeeFormError');

            if (password !== passwordConfirm) {
                feedback.classList.remove('text-success');
                feedback.classList.add('text-danger');
                feedback.textContent = 'Password dan konfirmasi password tidak cocok.';
                return;
            }

            const isMua = role.includes('MUA');
            const roleClass = isMua ? 'emp-role-mua' : 'emp-role-barber';
            const accountRow = document.createElement('div');
            accountRow.className = 'employee-account-row';

            const accountInitial = document.createElement('span');
            accountInitial.className = 'employee-avatar-initial';
            accountInitial.setAttribute('aria-hidden', 'true');
            accountInitial.textContent = name.charAt(0).toUpperCase();

            const accountDetails = document.createElement('div');
            accountDetails.className = 'employee-account-details';

            const accountName = document.createElement('div');
            accountName.className = 'employee-account-name';
            accountName.textContent = name;

            const accountMeta = document.createElement('div');
            accountMeta.className = 'employee-account-meta';
            accountMeta.textContent = `${username} · ${role}`;

            const accountStatus = document.createElement('span');
            accountStatus.className = 'employee-account-status';
            accountStatus.setAttribute('role', 'img');
            accountStatus.setAttribute('aria-label', 'Aktif');

            accountDetails.append(accountName, accountMeta);
            accountRow.append(accountInitial, accountDetails, accountStatus);
            document.getElementById('employeeAccountList').prepend(accountRow);

            const employeeCard = document.createElement('div');
            employeeCard.className = 'employee-card';

            const identity = document.createElement('div');
            identity.className = 'd-flex align-items-center gap-3';

            const avatar = document.createElement('div');
            avatar.className = 'avatar-wrapper';

            const avatarInitial = document.createElement('span');
            avatarInitial.className = 'employee-avatar-initial';
            avatarInitial.textContent = name.charAt(0).toUpperCase();

            const statusDot = document.createElement('span');
            statusDot.className = 'status-dot-active';
            avatar.append(avatarInitial, statusDot);

            const employeeDetails = document.createElement('div');
            const employeeName = document.createElement('div');
            employeeName.className = 'emp-name';
            employeeName.textContent = name;

            const employeeRole = document.createElement('div');
            employeeRole.className = roleClass;
            employeeRole.textContent = role;
            employeeDetails.append(employeeName, employeeRole);
            identity.append(avatar, employeeDetails);

            const employeeStats = document.createElement('div');
            employeeStats.className = 'text-end';

            const serviceCount = document.createElement('div');
            serviceCount.className = 'emp-stats-num';
            serviceCount.textContent = '0 layanan';

            const employeeStatus = document.createElement('div');
            employeeStatus.className = 'emp-status-badge';
            employeeStatus.textContent = 'Aktif';
            employeeStats.append(serviceCount, employeeStatus);
            employeeCard.append(identity, employeeStats);
            document.getElementById('employeeListContainer').prepend(employeeCard);

            e.currentTarget.reset();
            feedback.classList.remove('text-danger');
            feedback.classList.add('text-success');
            feedback.textContent = `${name} ditambahkan ke daftar pada halaman ini.`;
        }
    </script>
</body>
</html>
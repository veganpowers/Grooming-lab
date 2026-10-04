<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pendapatan - GlowCut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --bg-dark: #08080b;
            --card-bg: #121217;
            --card-border: #202029;
            --gold-primary: #e5be58;
            --text-muted: #8c8c9a;
            --accent-green: #34d399;
        }

        body {
            background-color: var(--bg-dark);
            color: #fff;
            font-family: 'Segoe UI', sans-serif;
        }

        .page-shell {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem 4rem;
        }

        .panel {
            background-color: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 1rem;
        }

        .metric-card {
            background: linear-gradient(145deg, #181510 0%, #121217 100%);
            border: 1px solid rgba(229, 190, 88, 0.3);
            border-radius: 1rem;
            padding: 1.25rem;
        }

        .text-gold {
            color: var(--gold-primary);
        }

        .report-total {
            border: 1px solid rgba(229, 190, 88, 0.3);
            border-radius: 0.85rem;
            background: linear-gradient(145deg, #181510 0%, #121217 100%);
        }

        .report-filters select {
            width: auto;
            min-width: 150px;
        }

        .report-category-btn {
            border-color: var(--card-border);
            color: var(--text-muted);
        }

        .report-category-btn.active {
            border-color: var(--gold-primary);
            background: var(--gold-primary);
            color: #111;
        }

        .report-list {
            overflow: hidden;
            border: 1px solid var(--card-border);
            border-radius: 0.8rem;
        }

        .report-list-heading,
        .report-transaction {
            display: grid;
            grid-template-columns: 4.5rem minmax(0, 1fr) auto;
            align-items: center;
            gap: 0.75rem;
            padding: 0.8rem 1rem;
        }

        .report-list-heading {
            background: #17171d;
            color: var(--text-muted);
            font-size: 0.72rem;
            font-weight: 700;
        }

        .report-transaction + .report-transaction {
            border-top: 1px solid var(--card-border);
        }

        .report-date-time,
        .report-service-meta {
            color: var(--text-muted);
            font-size: 0.72rem;
        }

        .report-service-name {
            color: #fff;
            font-size: 0.84rem;
            font-weight: 700;
        }

        .report-type-badge {
            display: inline-block;
            margin-right: 0.4rem;
            color: var(--gold-primary);
            font-size: 0.65rem;
            text-transform: uppercase;
        }

        .report-type-badge.walkin {
            color: var(--accent-green);
        }

        .report-amount {
            color: #fff;
            font-size: 0.82rem;
            font-weight: 800;
            text-align: right;
            white-space: nowrap;
        }

        @media (max-width: 575.98px) {
            .report-list-heading,
            .report-transaction {
                grid-template-columns: 3.5rem minmax(0, 1fr) auto;
                gap: 0.45rem;
                padding: 0.7rem 0.55rem;
            }

            .report-service-name {
                font-size: 0.75rem;
            }

            .report-amount {
                font-size: 0.72rem;
            }
        }
    </style>
</head>
<body>
    <div class="page-shell">
        @include('Admin.partials.admin-page-header', [
            'title' => 'Laporan Pendapatan',
            'backRoute' => route('admin.dashboard')
        ])

        <section class="report-total p-3 p-md-4 mb-3">
            <div class="small text-muted mb-1">Pendapatan Bulan Ini</div>
            <div class="h3 fw-bold text-gold mb-2">Rp 74.800.000</div>
            <div class="d-flex flex-wrap gap-3 small">
                <span class="text-muted">Barbershop <strong class="text-white ms-1">Rp 48.200.000</strong></span>
                <span class="text-muted">MUA <strong class="text-white ms-1">Rp 26.600.000</strong></span>
            </div>
        </section>

        <section class="panel p-3 p-md-4">
            <div class="report-filters d-flex flex-wrap align-items-center gap-2 mb-3">
                <label class="visually-hidden" for="reportDateFilter">Filter tanggal</label>
                <select id="reportDateFilter" class="form-select bg-dark text-white border-secondary" onchange="filterReportTransactions()">
                    <option value="all">Semua Tanggal</option>
                    <option value="2026-09-15">15 Sep</option>
                    <option value="2026-09-14">14 Sep</option>
                </select>
                <div class="btn-group" role="group" aria-label="Filter kategori laporan">
                    <button type="button" class="btn report-category-btn active" data-category="all" aria-pressed="true" onclick="filterReportTransactions('all')">Semua</button>
                    <button type="button" class="btn report-category-btn" data-category="barber" aria-pressed="false" onclick="filterReportTransactions('barber')">Barber</button>
                    <button type="button" class="btn report-category-btn" data-category="mua" aria-pressed="false" onclick="filterReportTransactions('mua')">MUA</button>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-2">
                <h2 class="h6 text-white fw-bold mb-0">Tabel Pemasukan</h2>
                <span class="small text-muted" id="reportTransactionCount">8 transaksi pratinjau</span>
            </div>
            <div class="report-list" id="reportTransactionList">
                <div class="report-list-heading"><span>Tanggal</span><span>Layanan</span><span class="text-end">Nominal</span></div>
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
            <button type="button" class="btn btn-warning fw-bold mt-3" onclick="downloadReport()">
                <i class="fa-solid fa-file-arrow-down me-2"></i>Unduh Laporan PDF
            </button>
        </section>
    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="reportToast" class="toast text-bg-success border-0" role="status" aria-live="polite">
            <div class="d-flex"><div class="toast-body" id="reportToastMessage"></div><button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Tutup"></button></div>
        </div>
    </div>

    <script>
        let reportCategoryFilter = 'all';

        function filterReportTransactions(category) {
            if (category) {
                reportCategoryFilter = category;
            }

            document.querySelectorAll('.report-category-btn').forEach((button) => {
                const isActive = button.dataset.category === reportCategoryFilter;
                button.classList.toggle('active', isActive);
                button.setAttribute('aria-pressed', String(isActive));
            });

            const selectedDate = document.getElementById('reportDateFilter').value;
            let visibleTransactions = 0;

            document.querySelectorAll('.report-transaction').forEach((transaction) => {
                const matchesCategory = reportCategoryFilter === 'all' || transaction.dataset.category === reportCategoryFilter;
                const matchesDate = selectedDate === 'all' || transaction.dataset.date === selectedDate;
                const isVisible = matchesCategory && matchesDate;

                transaction.classList.toggle('d-none', !isVisible);
                visibleTransactions += isVisible ? 1 : 0;
            });

            document.getElementById('reportTransactionCount').textContent = `${visibleTransactions} transaksi pratinjau`;
            document.getElementById('reportEmptyState').classList.toggle('d-none', visibleTransactions > 0);
        }

        function downloadReport() {
            const toastElement = document.getElementById('reportToast');
            document.getElementById('reportToastMessage').textContent = 'Laporan pendapatan PDF sedang diunduh.';

            if (window.bootstrap && window.bootstrap.Toast) {
                window.bootstrap.Toast.getOrCreateInstance(toastElement).show();
            }
        }
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Karyawan - GlowCut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --bg-dark: #1d1f24;
            --bg-panel: #23262d;
            --gold: #f3c65d;
            --text: #f4f4f4;
            --muted: #a5a5a8;
            --border: rgba(255, 255, 255, 0.18);
        }

        * {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            padding: 0;
            min-height: 100%;
            background: var(--bg-dark);
            color: var(--text);
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            min-height: 100vh;
        }

        .blank-admin-page {
            min-height: 100vh;
            background: #1f2127;
            padding: 1.2rem 1.5rem 2rem;
        }

        .blank-admin-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            min-height: 120px;
            border-bottom: 1px solid rgba(255,255,255,0.04);
            padding: 0.3rem 0 0.5rem;
        }

        .blank-admin-label {
            color: var(--gold);
            font-size: 0.82rem;
            font-weight: 800;
            letter-spacing: 0.12rem;
            text-transform: uppercase;
            margin: 0 0 0.35rem;
        }

        .blank-admin-title {
            font-size: clamp(2.5rem, 5vw, 5rem);
            line-height: 0.95;
            font-weight: 700;
            letter-spacing: -0.06em;
            color: #f3f3f3;
            margin: 0;
            font-family: Georgia, 'Times New Roman', serif;
        }

        .blank-admin-back {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.7rem;
            border: 1px solid rgba(255,255,255,0.28);
            border-radius: 999px;
            background: transparent;
            color: var(--text);
            padding: 0.8rem 1.4rem;
            font-size: 1.05rem;
            font-weight: 600;
            text-decoration: none;
            white-space: nowrap;
            transition: all 0.2s ease;
        }

        .blank-admin-back:hover {
            border-color: rgba(255,255,255,0.5);
            background: rgba(255,255,255,0.02);
            color: #fff;
            text-decoration: none;
        }

        .blank-admin-back i {
            font-size: 1rem;
        }

        .blank-admin-content {
            min-height: calc(100vh - 140px);
            max-width: 760px;
            margin: 2rem auto 0;
        }

        .employee-account-list {
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.14);
            border-radius: 0.8rem;
            background: #23262d;
        }

        .employee-account-row {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.8rem 1rem;
        }

        .employee-account-row + .employee-account-row {
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .employee-avatar-initial {
            display: grid;
            width: 2.4rem;
            height: 2.4rem;
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
            color: #f5f5f6;
            font-size: 0.9rem;
            font-weight: 700;
        }

        .employee-account-meta {
            color: var(--muted);
            font-size: 0.75rem;
        }

        .employee-account-status {
            width: 0.55rem;
            height: 0.55rem;
            border-radius: 50%;
            background: #43d59a;
        }

        .employee-create-form {
            padding: 1rem;
            border: 1px solid rgba(255,255,255,0.14);
            border-radius: 0.8rem;
            background: #23262d;
        }

        .employee-create-form .form-label {
            color: #d2d2d5;
            font-size: 0.82rem;
            font-weight: 700;
        }

        .employee-create-form .form-control,
        .employee-create-form .form-select {
            border-color: rgba(255,255,255,0.16);
            background-color: #1d1f24;
            color: #f4f4f4;
        }

        .employee-add-toggle {
            width: 100%;
            margin: 1rem 0;
            padding: 0.75rem 1rem;
            border: 1px solid rgba(243,198,93,0.45);
            border-radius: 0.7rem;
            background: transparent;
            color: var(--gold);
            font-weight: 700;
        }

        .employee-submit {
            border: 0;
            background: var(--gold);
            color: #1d1f24;
            font-weight: 800;
        }

        @media (max-width: 767.98px) {
            .blank-admin-page {
                padding: 1rem 1rem 2rem;
            }

            .blank-admin-header {
                flex-direction: column;
                align-items: flex-start;
                justify-content: center;
                min-height: auto;
                padding-top: 0.25rem;
            }

            .blank-admin-back {
                align-self: flex-end;
            }
        }
    </style>
</head>
<body>
    <div class="blank-admin-page">
        <header class="blank-admin-header">
            <div>
                <div class="blank-admin-label">Admin</div>
                <h1 class="blank-admin-title">Kelola Karyawan</h1>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="blank-admin-back">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Kembali ke Dashboard</span>
            </a>
        </header>

        <main class="blank-admin-content">
            <div class="employee-account-list" id="employeeAccountList" aria-label="Daftar karyawan aktif">
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

            <button type="button" class="employee-add-toggle" id="employeeFormToggle" aria-expanded="true" aria-controls="employeeCreateForm" onclick="toggleEmployeeForm()">
                <i class="fa-solid fa-plus me-2" aria-hidden="true"></i><span id="employeeFormToggleText">Tambah Karyawan</span>
            </button>

            <form class="employee-create-form" id="employeeCreateForm" onsubmit="handleAddEmployee(event)">
                <div class="mb-3">
                    <label for="newEmpName" class="form-label">Nama Lengkap</label>
                    <input type="text" id="newEmpName" required class="form-control" placeholder="Contoh: Rina Andini" autocomplete="name">
                </div>
                <div class="mb-3">
                    <label for="newEmpUsername" class="form-label">Username</label>
                    <input type="text" id="newEmpUsername" required class="form-control" placeholder="Contoh: rina.andini" autocomplete="username">
                </div>
                <div class="mb-3">
                    <label for="newEmpPassword" class="form-label">Password</label>
                    <input type="password" id="newEmpPassword" required minlength="8" class="form-control" placeholder="Minimal 8 karakter" autocomplete="new-password">
                </div>
                <div class="mb-3">
                    <label for="newEmpPasswordConfirm" class="form-label">Ulangi Password</label>
                    <input type="password" id="newEmpPasswordConfirm" required minlength="8" class="form-control" placeholder="Ulangi password" autocomplete="new-password">
                </div>
                <div class="mb-3">
                    <label for="newEmpRole" class="form-label">Peran / Posisi</label>
                    <select id="newEmpRole" class="form-select">
                        <option value="MUA Artist">MUA Artist</option>
                        <option value="Hair Stylist">Hair Stylist</option>
                    </select>
                </div>
                <div class="small text-danger mb-3" id="employeeFormError" role="alert"></div>
                <button type="submit" class="btn employee-submit w-100">
                    <i class="fa-solid fa-plus me-1" aria-hidden="true"></i>Buat Akun Karyawan
                </button>
            </form>
        </main>
    </div>

    <script>
        function toggleEmployeeForm() {
            const form = document.getElementById('employeeCreateForm');
            const toggle = document.getElementById('employeeFormToggle');
            const isExpanded = toggle.getAttribute('aria-expanded') === 'true';

            form.hidden = isExpanded;
            toggle.setAttribute('aria-expanded', String(!isExpanded));
            document.getElementById('employeeFormToggleText').textContent = isExpanded ? 'Tambah Karyawan' : 'Tutup Form';
        }

        function handleAddEmployee(event) {
            event.preventDefault();

            const nameInput = document.getElementById('newEmpName');
            const usernameInput = document.getElementById('newEmpUsername');
            const passwordInput = document.getElementById('newEmpPassword');
            const confirmInput = document.getElementById('newEmpPasswordConfirm');
            const roleInput = document.getElementById('newEmpRole');
            const feedback = document.getElementById('employeeFormError');
            const name = nameInput.value.trim();

            if (passwordInput.value !== confirmInput.value) {
                feedback.textContent = 'Password dan konfirmasi password tidak cocok.';
                confirmInput.focus();
                return;
            }

            const row = document.createElement('div');
            row.className = 'employee-account-row';

            const initial = document.createElement('span');
            initial.className = 'employee-avatar-initial';
            initial.setAttribute('aria-hidden', 'true');
            initial.textContent = name.charAt(0).toUpperCase();

            const details = document.createElement('div');
            details.className = 'employee-account-details';

            const employeeName = document.createElement('div');
            employeeName.className = 'employee-account-name';
            employeeName.textContent = name;

            const employeeMeta = document.createElement('div');
            employeeMeta.className = 'employee-account-meta';
            employeeMeta.textContent = `${usernameInput.value.trim()} · ${roleInput.value}`;

            const status = document.createElement('span');
            status.className = 'employee-account-status';
            status.setAttribute('role', 'img');
            status.setAttribute('aria-label', 'Aktif');

            details.append(employeeName, employeeMeta);
            row.append(initial, details, status);
            document.getElementById('employeeAccountList').prepend(row);

            event.currentTarget.reset();
            feedback.textContent = `${name} ditambahkan ke daftar pada halaman ini.`;
            feedback.classList.remove('text-danger');
            feedback.classList.add('text-success');
        }
    </script>
</body>
</html>

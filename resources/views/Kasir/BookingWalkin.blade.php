<style>
	.walkin-dialog {
		max-width: 560px;
		padding: 0 0.5rem;
	}

	.walkin-modal {
		position: fixed;
		inset: 0;
		z-index: 1055;
		display: none;
		overflow-y: auto;
		padding: 0.5rem;
		background: rgba(0, 0, 0, 0.78);
	}

	.walkin-modal.show {
		display: block;
	}

	.walkin-modal .modal-dialog {
		display: flex;
		align-items: center;
		min-height: calc(100% - 1rem);
		margin: 0.5rem auto;
	}

	.walkin-modal .modal-content {
		width: 100%;
	}

	body.walkin-open {
		overflow: hidden;
	}

	.walkin-content {
		background: #1c1b19;
		border: 1px solid #302f2b;
		border-radius: 1.4rem;
		color: #f6f3ec;
		box-shadow: 0 24px 70px rgba(0, 0, 0, 0.55);
	}

	.walkin-header {
		display: flex;
		align-items: flex-start;
		justify-content: space-between;
		gap: 1rem;
		border: 0;
		padding: 1.5rem 1.5rem 0.65rem;
	}

	.walkin-header > div:first-child {
		flex: 1;
		min-width: 0;
	}

	.walkin-eyebrow {
		color: #c9b77e;
		font-size: 0.62rem;
		font-weight: 800;
		letter-spacing: 1.5px;
		margin-bottom: 0.45rem;
	}

	.walkin-title {
		color: #f6f3ec !important;
		font-family: 'DM Serif Display', serif;
		font-size: 1.8rem;
		margin: 0;
	}

	.walkin-close {
		width: 40px;
		height: 40px;
		flex: 0 0 40px;
		margin-left: auto;
		border: 1px solid #383733;
		border-radius: 0.8rem;
		display: grid;
		place-items: center;
		background: transparent;
		color: #e7e3da;
		font-size: 1.2rem;
		line-height: 1;
	}

	.walkin-close:hover {
		border-color: var(--gold-primary);
		color: var(--gold-primary);
	}

	.walkin-body {
		padding: 0.65rem 1.5rem 1.5rem;
	}

	.walkin-label {
		color: #aaa69d;
		font-size: 0.68rem;
		font-weight: 800;
		letter-spacing: 0.7px;
		margin-bottom: 0.55rem;
	}

	.walkin-input {
		background: #121212;
		border: 1px solid #2b2a27;
		border-radius: 0.8rem;
		color: #f6f3ec;
		min-height: 48px;
		padding: 0.75rem 0.9rem;
	}

	.walkin-input::placeholder {
		color: #77746e;
	}

	.walkin-input:focus {
		background: #121212;
		border-color: var(--gold-primary);
		box-shadow: 0 0 0 0.2rem rgba(229, 190, 88, 0.12);
		color: #fff;
	}

	.walkin-categories {
		display: flex;
		gap: 0.3rem;
		padding: 0.3rem;
		background: #151514;
		border: 1px solid #2b2a27;
		border-radius: 0.9rem;
	}

	.walkin-category-btn {
		flex: 1;
		min-height: 40px;
		border: 0;
		border-radius: 0.55rem;
		background: transparent;
		color: #c9c5bd;
		font-weight: 700;
	}

	.walkin-category-btn.active {
		background: var(--gold-primary);
		color: #171511;
	}

	.walkin-services {
		display: grid;
		gap: 0.45rem;
		max-height: 220px;
		overflow-y: auto;
	}

	.walkin-service-option {
		position: relative;
		display: block;
		padding: 0.6rem 0.75rem;
		border: 1px solid transparent;
		background: #191918;
		color: #e9e6df;
		cursor: pointer;
		text-align: center;
		transition: background 0.15s ease, border-color 0.15s ease;
	}

	.walkin-service-option:hover,
	.walkin-service-option:has(input:checked) {
		background: #222118;
		border-color: rgba(229, 190, 88, 0.55);
	}

	.walkin-service-option input {
		position: absolute;
		width: 1px;
		height: 1px;
		opacity: 0;
	}

	.walkin-service-option input:focus-visible + .walkin-service-name {
		outline: 2px solid var(--gold-primary);
		outline-offset: 3px;
	}

	.walkin-service-name {
		display: block;
		font-size: 0.92rem;
		font-weight: 800;
	}

	.walkin-service-detail {
		display: block;
		margin-top: 0.25rem;
		color: #99958c;
		font-size: 0.66rem;
		text-transform: uppercase;
	}

	.walkin-service-price {
		color: var(--gold-primary);
		font-size: 0.8rem;
		font-weight: 800;
		margin-left: 0.2rem;
	}

	.walkin-actions {
		display: flex;
		gap: 0.65rem;
		margin-top: 1.35rem;
	}

	.walkin-actions button {
		flex: 1;
		min-height: 48px;
		border-radius: 0.8rem;
		font-weight: 800;
	}

	.walkin-cancel {
		background: transparent;
		border: 1px solid #383733;
		color: #e7e3da;
	}

	.walkin-cancel:hover {
		border-color: #77746e;
		color: #fff;
	}

	.walkin-save {
		background: var(--gold-primary);
		border: 1px solid var(--gold-primary);
		color: #171511;
	}

	.walkin-save:hover {
		background: #f0cb65;
		border-color: #f0cb65;
		color: #171511;
	}

	@media (max-width: 575.98px) {
		.walkin-dialog {
			margin: 0.75rem auto;
		}

		.walkin-header {
			padding: 1.25rem 1.15rem 0.55rem;
		}

		.walkin-body {
			padding: 0.65rem 1.15rem 1.15rem;
		}

		.walkin-title {
			font-size: 1.6rem;
		}
	}
</style>

<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1090;">
	<div id="walkInToast" class="toast align-items-center text-bg-success border-0 rounded-3 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
		<div class="d-flex">
			<div class="toast-body d-flex align-items-center gap-2">
				<i class="fa-solid fa-circle-check fs-5"></i>
				<div>
					<strong class="d-block">Berhasil!</strong>
					<span class="small">Pelanggan walk-in telah ditambahkan.</span>
				</div>
			</div>
			<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
		</div>
	</div>
</div>

<div class="modal walkin-modal" id="walkInModal" tabindex="-1" aria-labelledby="walkInModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered walkin-dialog">
		<div class="modal-content walkin-content">
			<div class="modal-header walkin-header">
				<div>
					<div class="walkin-eyebrow">WALK-IN</div>
					<h2 class="walkin-title" id="walkInModalLabel">Pelanggan Baru</h2>
				</div>
				<button type="button" class="walkin-close" onclick="hideWalkInModal()" aria-label="Tutup">&times;</button>
			</div>
			<div class="modal-body walkin-body">
				<form id="walkInForm" onsubmit="addWalkInCustomer(event)">
					<div class="mb-3">
						<label for="walkInCustomerName" class="form-label walkin-label">NAMA PELANGGAN</label>
						<input id="walkInCustomerName" name="customer_name" type="text" required class="form-control walkin-input" placeholder="Masukkan nama">
					</div>
					<div class="walkin-categories mb-3" role="group" aria-label="Kategori layanan">
						<button type="button" class="walkin-category-btn active" data-category="barber" aria-pressed="true" onclick="setWalkInCategory('barber', this)">✂ Barber</button>
						<button type="button" class="walkin-category-btn" data-category="mua" aria-pressed="false" onclick="setWalkInCategory('mua', this)">💄 MUA</button>
					</div>
					<div id="walkInServices" class="walkin-services" aria-label="Pilih layanan"></div>
					<div class="walkin-actions">
						<button type="button" class="walkin-cancel" onclick="hideWalkInModal()">Batal</button>
						<button type="submit" class="walkin-save">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	let walkInCategory = 'barber';

	const walkInCatalog = {
		barber: [
			{ name: 'Fast Haircut', price: 25000 },
			{ name: 'Rileks Ganteng', price: 35000 },
			{ name: 'Full Grooming', price: 50000 }
		],
		mua: [
			{ name: 'Makeup Only', price: 250000 },
			{ name: 'Make Up + Soft Lens', price: 300000 },
			{ name: 'Make Up + Hijab/Hair Do', price: 320000 },
			{ name: 'Make Up + Hijab/Hair Do + Soft Lens', price: 360000 }
		]
	};

	function setWalkInCategory(category, button) {
		walkInCategory = category;
		document.querySelectorAll('.walkin-category-btn').forEach(categoryButton => {
			const isActive = categoryButton === button;
			categoryButton.classList.toggle('active', isActive);
			categoryButton.setAttribute('aria-pressed', isActive ? 'true' : 'false');
		});

		renderWalkInServices();
	}

	function renderWalkInServices() {
		const serviceList = document.getElementById('walkInServices');
		const serviceType = walkInCategory === 'barber' ? 'Barber service' : 'MUA service';

		serviceList.innerHTML = walkInCatalog[walkInCategory].map(service => `
			<label class="walkin-service-option">
				<input type="radio" name="walk_in_service" value="${service.name}" required>
				<span class="walkin-service-name">${service.name}</span>
				<span class="walkin-service-detail">${serviceType}<span class="walkin-service-price">Rp ${new Intl.NumberFormat('id-ID').format(service.price)}</span></span>
			</label>
		`).join('');
	}

	function showWalkInModal() {
		const modalEl = document.getElementById('walkInModal');
		modalEl.classList.add('show');
		modalEl.setAttribute('aria-hidden', 'false');
		modalEl.setAttribute('aria-modal', 'true');
		document.body.classList.add('walkin-open');
		document.getElementById('walkInCustomerName').focus();
	}

	function hideWalkInModal() {
		const modalEl = document.getElementById('walkInModal');
		modalEl.classList.remove('show');
		modalEl.setAttribute('aria-hidden', 'true');
		modalEl.removeAttribute('aria-modal');
		document.body.classList.remove('walkin-open');
	}

	function addWalkInCustomer(event) {
		event.preventDefault();
		hideWalkInModal();

		const toastEl = document.getElementById('walkInToast');
		if (toastEl && window.bootstrap && window.bootstrap.Toast) {
			new bootstrap.Toast(toastEl).show();
		} else if (toastEl) {
			toastEl.classList.add('show');
			window.setTimeout(() => toastEl.classList.remove('show'), 3000);
		}
	}

	renderWalkInServices();

	document.addEventListener('keydown', event => {
		if (event.key === 'Escape' && document.getElementById('walkInModal').classList.contains('show')) {
			hideWalkInModal();
		}
	});

	document.getElementById('walkInModal').addEventListener('click', event => {
		if (event.target === event.currentTarget) {
			hideWalkInModal();
		}
	});
</script>

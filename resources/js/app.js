const themeToggle = document.querySelector('[data-theme-toggle]');
const savedTheme = window.localStorage.getItem('ruang-rias-theme');

if (savedTheme === 'light') {
	document.body.classList.add('light-mode');
}

if (themeToggle) {
	const themeIcon = themeToggle.querySelector('[data-theme-icon]');

	const updateThemeToggle = () => {
		const isLightMode = document.body.classList.contains('light-mode');

		themeToggle.setAttribute('aria-label', isLightMode ? 'Aktifkan mode gelap' : 'Aktifkan mode terang');
		themeIcon.textContent = isLightMode ? '☾' : '☼';
	};

	updateThemeToggle();

	themeToggle.addEventListener('click', () => {
		document.body.classList.toggle('light-mode');
		window.localStorage.setItem('ruang-rias-theme', document.body.classList.contains('light-mode') ? 'light' : 'dark');
		updateThemeToggle();
	});
}

const loginForm = document.querySelector('.login-form');
const loginRoles = document.querySelectorAll('[data-login-role]');

if (loginForm && loginRoles.length) {
	const loginLabel = loginForm.querySelector('[data-login-label]');
	const loginEmail = loginForm.querySelector('#login-email');
	const loginSubmit = loginForm.querySelector('[data-login-submit]');
	const staffNote = loginForm.querySelector('[data-staff-note]');

	loginRoles.forEach((roleButton) => {
		roleButton.addEventListener('click', () => {
			const isStaff = roleButton.dataset.loginRole === 'staff';

			loginRoles.forEach((button) => button.classList.toggle('is-active', button === roleButton));
			loginForm.classList.toggle('staff-mode', isStaff);
			loginLabel.textContent = isStaff ? 'ID KARYAWAN / EMAIL' : 'NO. TELEPON / EMAIL';
			loginEmail.placeholder = isStaff ? 'kasir01@ruangrias.test' : 'pelanggan@ruangrias.test';
			loginSubmit.textContent = isStaff ? 'Masuk sebagai Kasir' : 'Masuk';
			staffNote.hidden = !isStaff;
		});
	});
}

document.addEventListener('DOMContentLoaded', function () {
	const toggle = document.querySelector('.azure-nav-toggle');
	const nav = document.querySelector('.azure-site-nav');

	if (!toggle || !nav) {
		return;
	}

	toggle.addEventListener('click', function () {
		const expanded = toggle.getAttribute('aria-expanded') === 'true';

		toggle.setAttribute('aria-expanded', expanded ? 'false' : 'true');
		document.body.classList.toggle('has-nav-open', !expanded);
	});
});

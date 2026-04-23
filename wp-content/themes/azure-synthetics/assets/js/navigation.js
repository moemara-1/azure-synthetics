document.addEventListener('DOMContentLoaded', function () {
	const toggle = document.querySelector('.azure-nav-toggle');
	const nav = document.querySelector('.azure-site-nav');

	if (!toggle || !nav) {
		return;
	}

	function closeNav() {
		toggle.setAttribute('aria-expanded', 'false');
		document.body.classList.remove('has-nav-open');
	}

	toggle.addEventListener('click', function () {
		const expanded = toggle.getAttribute('aria-expanded') === 'true';

		toggle.setAttribute('aria-expanded', expanded ? 'false' : 'true');
		document.body.classList.toggle('has-nav-open', !expanded);
	});

	document.addEventListener('keydown', function (event) {
		if (event.key === 'Escape') {
			closeNav();
		}
	});

	nav.querySelectorAll('a').forEach(function (link) {
		link.addEventListener('click', closeNav);
	});
});

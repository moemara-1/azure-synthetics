document.addEventListener('DOMContentLoaded', function () {
	const toggle = document.querySelector('.azure-nav-toggle');
	const nav = document.querySelector('.azure-site-nav');
	const scrim = document.querySelector('.azure-nav-scrim');

	if (!toggle || !nav) {
		return;
	}

	const closeNavigation = function () {
		toggle.setAttribute('aria-expanded', 'false');
		document.body.classList.remove('has-nav-open');
		nav.setAttribute('aria-hidden', 'true');
	};

	const openNavigation = function () {
		toggle.setAttribute('aria-expanded', 'true');
		document.body.classList.add('has-nav-open');
		nav.setAttribute('aria-hidden', 'false');
	};

	const syncNavigationState = function (forceClosed) {
		const expanded = !forceClosed && toggle.getAttribute('aria-expanded') === 'true';

		if (expanded) {
			openNavigation();
			return;
		}

		closeNavigation();
	};

	nav.querySelectorAll('a').forEach(function (link) {
		link.addEventListener('click', closeNavigation);
	});

	if (scrim) {
		scrim.addEventListener('click', closeNavigation);
	}

	window.addEventListener('resize', function () {
		if (window.innerWidth > 820) {
			closeNavigation();
		}
	});

	window.addEventListener('pageshow', closeNavigation);

	document.addEventListener('keydown', function (event) {
		if (event.key === 'Escape') {
			closeNavigation();
		}
	});

	closeNavigation();

	toggle.addEventListener('click', function () {
		const expanded = toggle.getAttribute('aria-expanded') === 'true';

		toggle.setAttribute('aria-expanded', expanded ? 'false' : 'true');
		syncNavigationState(false);
	});
});

document.addEventListener('DOMContentLoaded', function () {
	const toggle = document.querySelector('.azure-nav-toggle');
	const nav = document.querySelector('.azure-site-nav');
	const scrim = document.querySelector('.azure-nav-scrim');
	const navState = document.querySelector('.azure-nav-state');
	const mobileQuery = window.matchMedia('(max-width: 820px)');

	if (!toggle || !nav) {
		return;
	}

	const closeNavigation = function () {
		toggle.setAttribute('aria-expanded', 'false');
		document.body.classList.remove('has-nav-open');

		if (navState) {
			navState.checked = false;
		}

		if (mobileQuery.matches) {
			nav.setAttribute('aria-hidden', 'true');
		} else {
			nav.removeAttribute('aria-hidden');
		}
	};

	const openNavigation = function () {
		toggle.setAttribute('aria-expanded', 'true');
		document.body.classList.add('has-nav-open');
		nav.setAttribute('aria-hidden', 'false');

		if (navState) {
			navState.checked = true;
		}
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
		link.addEventListener('click', function () {
			window.setTimeout(closeNavigation, 120);
		});

		link.addEventListener(
			'touchend',
			function (event) {
				const href = link.getAttribute('href');

				if (!mobileQuery.matches || !href || href.charAt(0) === '#') {
					return;
				}

				event.preventDefault();
				window.location.assign(link.href);
			},
			{ passive: false }
		);
	});

	if (scrim) {
		scrim.addEventListener('click', closeNavigation);
	}

	if (navState) {
		navState.addEventListener('change', function () {
			if (navState.checked) {
				openNavigation();
			} else {
				closeNavigation();
			}
		});
	}

	const handleViewportChange = function () {
		closeNavigation();
	};

	if (mobileQuery.addEventListener) {
		mobileQuery.addEventListener('change', handleViewportChange);
	} else if (mobileQuery.addListener) {
		mobileQuery.addListener(handleViewportChange);
	}

	window.addEventListener('pageshow', closeNavigation);

	document.addEventListener('keydown', function (event) {
		if (event.key === 'Escape') {
			closeNavigation();
		}
	});

	closeNavigation();

	toggle.addEventListener('click', function () {
		if (!mobileQuery.matches) {
			return;
		}

		if (navState) {
			return;
		}

		const expanded = toggle.getAttribute('aria-expanded') === 'true';

		toggle.setAttribute('aria-expanded', expanded ? 'false' : 'true');
		syncNavigationState(false);
	});

	toggle.addEventListener('keydown', function (event) {
		if (!navState || (event.key !== 'Enter' && event.key !== ' ')) {
			return;
		}

		event.preventDefault();
		navState.checked = !navState.checked;
		navState.dispatchEvent(new Event('change', { bubbles: true }));
	});
});

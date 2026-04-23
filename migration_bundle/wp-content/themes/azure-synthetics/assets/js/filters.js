document.addEventListener('DOMContentLoaded', function () {
	const filterToggle = document.querySelector('[data-azure-filter-toggle]');

	if (!filterToggle) {
		return;
	}

	const closeFilters = function () {
		document.body.classList.remove('has-filters-open');
	};

	window.addEventListener('resize', function () {
		if (window.innerWidth > 820) {
			closeFilters();
		}
	});

	window.addEventListener('pageshow', closeFilters);

	document.addEventListener('keydown', function (event) {
		if (event.key === 'Escape') {
			closeFilters();
		}
	});

	closeFilters();

	filterToggle.addEventListener('click', function () {
		document.body.classList.toggle('has-filters-open');
	});
});

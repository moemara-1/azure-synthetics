document.addEventListener('DOMContentLoaded', function () {
	const filterToggle = document.querySelector('[data-azure-filter-toggle]');

	if (!filterToggle) {
		return;
	}

	function closeFilters() {
		document.body.classList.remove('has-filters-open');
	}

	filterToggle.addEventListener('click', function () {
		document.body.classList.toggle('has-filters-open');
	});

	document.addEventListener('keydown', function (event) {
		if (event.key === 'Escape') {
			closeFilters();
		}
	});
});

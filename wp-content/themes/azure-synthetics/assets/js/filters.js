document.addEventListener('DOMContentLoaded', function () {
	const filterToggle = document.querySelector('[data-azure-filter-toggle]');

	if (!filterToggle) {
		return;
	}

	filterToggle.addEventListener('click', function () {
		document.body.classList.toggle('has-filters-open');
	});
});

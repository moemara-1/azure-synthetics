document.addEventListener('DOMContentLoaded', function () {
	const repeater = document.querySelector('[data-azure-faq-repeater]');
	const addButton = document.querySelector('[data-azure-add-faq]');
	const template = document.getElementById('azure-faq-row-template');

	if (!repeater || !addButton || !template) {
		return;
	}

	const refreshIndexes = function () {
		repeater.querySelectorAll('.azure-faq-repeater__row').forEach(function (row, index) {
			row.querySelectorAll('input, textarea').forEach(function (field) {
				field.name = field.name.replace(/\[\d+\]/, '[' + index + ']');
			});
		});
	};

	addButton.addEventListener('click', function () {
		const nextIndex = repeater.querySelectorAll('.azure-faq-repeater__row').length;
		const markup = template.innerHTML.replaceAll('__index__', String(nextIndex));
		repeater.insertAdjacentHTML('beforeend', markup);
	});

	repeater.addEventListener('click', function (event) {
		if (!event.target.matches('[data-azure-remove-faq]')) {
			return;
		}

		const row = event.target.closest('.azure-faq-repeater__row');
		if (row) {
			row.remove();
			refreshIndexes();
		}
	});
});

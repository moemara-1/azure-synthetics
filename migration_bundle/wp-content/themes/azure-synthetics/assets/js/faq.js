document.addEventListener('DOMContentLoaded', function () {
	document.querySelectorAll('.azure-accordion').forEach(function (item) {
		item.addEventListener('toggle', function () {
			if (!item.open) {
				return;
			}

			document.querySelectorAll('.azure-accordion').forEach(function (other) {
				if (other !== item && other.closest('.azure-product-faqs') === item.closest('.azure-product-faqs')) {
					other.open = false;
				}
			});
		});
	});
});

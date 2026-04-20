document.addEventListener('DOMContentLoaded', function () {
	if (!window.azureSyntheticsCompliance || !window.azureSyntheticsCompliance.catalogGateEnabled) {
		return;
	}

	if (window.localStorage.getItem('azureCatalogGateAccepted') === '1') {
		return;
	}

	const banner = document.createElement('div');
	banner.className = 'azure-catalog-gate';
	banner.innerHTML =
		'<div class="azure-catalog-gate__panel">' +
		'<p>' + window.azureSyntheticsCompliance.disclaimer + '</p>' +
		'<button type="button" class="azure-button">Acknowledge</button>' +
		'</div>';

	document.body.appendChild(banner);

	banner.querySelector('button').addEventListener('click', function () {
		window.localStorage.setItem('azureCatalogGateAccepted', '1');
		banner.remove();
	});
});

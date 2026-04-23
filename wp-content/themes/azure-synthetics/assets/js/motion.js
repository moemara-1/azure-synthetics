document.addEventListener('DOMContentLoaded', function () {
	if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
		return;
	}

	const selector = [
		'.azure-page-hero > .azure-shell > *',
		'.azure-credibility-rail__inner > *',
		'.azure-editorial-section__grid > *',
		'.azure-story-grid > *',
		'.azure-product-grid > *',
		'.azure-science-grid__layout > *',
		'.azure-science-grid__subcards > *',
		'.azure-collection-row',
		'.azure-newsletter-card',
		'.azure-shop-highlight-grid > *',
		'.azure-collection-spotlight__grid > *',
		'.woocommerce ul.products > li',
		'.azure-product-layout > *',
		'.azure-product-tech-grid > *',
		'.azure-product-section',
		'.azure-science-tier-grid > *',
		'.azure-science-explainer-grid > *',
		'.azure-science-process-list > *',
		'.azure-accordion-list > *'
	].join(',');

	const nodes = document.querySelectorAll(selector);

	if (!nodes.length) {
		return;
	}

	document.body.classList.add('azure-motion-ready');

	const observer = new IntersectionObserver(function (entries) {
		entries.forEach(function (entry) {
			if (!entry.isIntersecting) {
				return;
			}

			entry.target.classList.add('azure-reveal', 'is-visible');
			observer.unobserve(entry.target);
		});
	}, {
		rootMargin: '0px 0px -10% 0px',
		threshold: 0.12
	});

	nodes.forEach(function (node) {
		node.classList.add('azure-reveal');
		observer.observe(node);
	});
});

(function () {
	const body = document.body;
	const nav = document.getElementById('opt-nav');

	if (nav) {
		const setNavState = () => {
			nav.classList.toggle('is-scrolled', window.scrollY > 24);
		};

		window.addEventListener('scroll', setNavState, { passive: true });
		setNavState();
	}

	document.querySelectorAll('[data-optimization-drawer]').forEach((control) => {
		control.addEventListener('click', () => {
			const action = control.getAttribute('data-optimization-drawer');
			const isOpen = action === 'open';
			body.classList.toggle('has-opt-drawer', isOpen);

			const drawer = document.getElementById('opt-drawer');
			if (drawer) {
				drawer.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
			}
		});
	});

	const rotator = document.querySelector('[data-optimization-rotator]');
	if (rotator) {
		let words = [];

		try {
			words = JSON.parse(rotator.getAttribute('data-words') || '[]');
		} catch (error) {
			words = ['signal.', 'system.', 'standard.'];
		}

		if (Array.isArray(words) && words.length > 1) {
			let index = 0;

			window.setInterval(() => {
				index = (index + 1) % words.length;
				rotator.classList.add('is-swapping');

				window.setTimeout(() => {
					rotator.textContent = words[index];
					rotator.classList.remove('is-swapping');
				}, 260);
			}, 2400);
		}
	}

	document.querySelectorAll('[data-optimization-copy]').forEach((button) => {
		button.addEventListener('click', async (event) => {
			event.preventDefault();
			const value = button.getAttribute('data-optimization-copy') || button.textContent.trim();

			try {
				await navigator.clipboard.writeText(value);
			} catch (error) {
				const selection = window.getSelection();
				const range = document.createRange();
				range.selectNodeContents(button);
				selection.removeAllRanges();
				selection.addRange(range);
				document.execCommand('copy');
				selection.removeAllRanges();
			}

			button.classList.add('is-copied');
			const original = button.textContent;
			button.textContent = 'Copied';

			window.setTimeout(() => {
				button.classList.remove('is-copied');
				button.textContent = original;
			}, 1400);
		});
	});

	const clock = document.querySelector('[data-optimization-clock]');
	if (clock) {
		const tick = () => {
			const now = new Date();
			const hours = String(now.getUTCHours()).padStart(2, '0');
			const minutes = String(now.getUTCMinutes()).padStart(2, '0');
			clock.textContent = `${hours}:${minutes} UTC`;
		};

		tick();
		window.setInterval(tick, 1000);
	}

	const readouts = document.querySelectorAll('[data-optimization-readout]');
	if (readouts.length) {
		const ranges = {
			evidence: [80, 88],
			proof: [88, 96],
			restraint: [97, 100],
		};

		const update = () => {
			readouts.forEach((node) => {
				const key = node.getAttribute('data-optimization-readout');
				const range = ranges[key] || [80, 99];
				const value = Math.round(range[0] + Math.random() * (range[1] - range[0]));
				node.textContent = `${value}%`;
			});
		};

		update();
		window.setInterval(update, 1800);
	}

	const calc = {
		otherInputs: document.querySelectorAll('[data-calc-other]'),
		chipGroups: document.querySelectorAll('[data-calc-chips]'),
		syringes: document.querySelectorAll('[data-syringe-index]'),
		volume: document.querySelector('[data-calc-output="volume"]'),
		units: document.querySelector('[data-calc-output="units"]'),
		targets: document.querySelector('[data-calc-output="targets"]'),
		scale: document.querySelector('[data-calc-scale]'),
	};

	if (calc.chipGroups.length && calc.syringes.length) {
		const syringeTypes = [
			{ ml: 0.3, units: 30 },
			{ ml: 0.5, units: 50 },
			{ ml: 1, units: 100 },
		];
		const state = { syringeIndex: 2, mass: 10, fluid: 2, target: 100 };

		const toPositiveNumber = (value) => {
			const parsed = Number.parseFloat(value);
			return Number.isFinite(parsed) && parsed > 0 ? parsed : 0;
		};

		const updateScale = (unitMark, totalUnits) => {
			if (!calc.scale) {
				return;
			}

			const width = 540;
			const left = 36;
			const right = 500;
			const barrelWidth = right - left;
			const clamped = Math.max(0, Math.min(unitMark, totalUnits));
			const drawX = left + (clamped / totalUnits) * barrelWidth;
			const ticks = [];

			for (let index = 0; index <= 10; index += 1) {
				const x = left + (index / 10) * barrelWidth;
				const label = Math.round((index / 10) * totalUnits);
				const height = index % 5 === 0 ? 22 : 13;
				ticks.push(`<line x1="${x}" y1="24" x2="${x}" y2="${24 + height}" />`);
				if (index % 2 === 0) {
					ticks.push(`<text x="${x}" y="66">${label}</text>`);
				}
			}

			calc.scale.innerHTML = `
				<line class="opt-calc-scale__needle" x1="500" y1="24" x2="${width - 8}" y2="24" />
				<rect class="opt-calc-scale__barrel" x="${left}" y="14" width="${barrelWidth}" height="20" rx="4" />
				<rect class="opt-calc-scale__fill" x="${left}" y="14" width="${Math.max(0, drawX - left)}" height="20" rx="4" />
				<line class="opt-calc-scale__mark" x1="${drawX}" y1="7" x2="${drawX}" y2="50" />
				${ticks.join('')}
			`;
		};

		const calculate = () => {
			const syringe = syringeTypes[state.syringeIndex] || syringeTypes[2];
			const totalMcg = state.mass * 1000;
			const concentration = totalMcg / state.fluid;
			const volume = state.target / concentration;
			const unitMark = volume * (syringe.units / syringe.ml);
			const targets = totalMcg / state.target;

			if (!Number.isFinite(volume) || !Number.isFinite(unitMark) || !Number.isFinite(targets)) {
				if (calc.volume) calc.volume.textContent = '--';
				if (calc.units) calc.units.textContent = '--';
				if (calc.targets) calc.targets.textContent = 'Targets per vial at this quantity: --';
				updateScale(0, syringe.units);
				return;
			}

			if (calc.volume) calc.volume.textContent = `${volume.toFixed(3)} mL`;
			if (calc.units) calc.units.textContent = `${unitMark.toFixed(1)} units`;
			if (calc.targets) calc.targets.textContent = `Targets per vial at this quantity: ${Math.floor(targets).toLocaleString()}`;
			updateScale(unitMark, syringe.units);
		};

		calc.syringes.forEach((button) => {
			button.addEventListener('click', () => {
				state.syringeIndex = Number.parseInt(button.getAttribute('data-syringe-index') || '2', 10);
				calc.syringes.forEach((node) => {
					node.classList.remove('is-selected');
					node.setAttribute('aria-pressed', 'false');
				});
				button.classList.add('is-selected');
				button.setAttribute('aria-pressed', 'true');
				calculate();
			});
		});

		calc.chipGroups.forEach((group) => {
			const key = group.getAttribute('data-calc-chips');
			group.addEventListener('click', (event) => {
				const button = event.target.closest('button[data-value]');
				if (!button || !key) {
					return;
				}

				const value = toPositiveNumber(button.getAttribute('data-value'));
				if (!value) {
					return;
				}

				state[key] = value;
				group.querySelectorAll('button').forEach((node) => node.classList.remove('is-selected'));
				button.classList.add('is-selected');

				const other = document.querySelector(`[data-calc-other="${key}"]`);
				if (other) {
					other.value = '';
				}

				calculate();
			});
		});

		calc.otherInputs.forEach((input) => {
			input.addEventListener('input', () => {
				const key = input.getAttribute('data-calc-other');
				const value = toPositiveNumber(input.value);
				if (!key || !value) {
					return;
				}

				state[key] = value;
				const group = document.querySelector(`[data-calc-chips="${key}"]`);
				if (group) {
					group.querySelectorAll('button').forEach((node) => node.classList.remove('is-selected'));
				}

				calculate();
			});
		});

		calculate();
	}

	if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
		const revealTargets = document.querySelectorAll('.opt-reveal, .opt-reveal-stagger');
		if (revealTargets.length) {
			const observer = new IntersectionObserver((entries) => {
				entries.forEach((entry) => {
					if (!entry.isIntersecting) {
						return;
					}

					entry.target.classList.add('is-in');
					observer.unobserve(entry.target);
				});
			}, {
				rootMargin: '0px 0px -10% 0px',
				threshold: 0.12,
			});

			revealTargets.forEach((node) => observer.observe(node));
		}

		const heroMolecule = document.querySelector('.opt-hero__molecule');
		if (heroMolecule) {
			window.addEventListener('mousemove', (event) => {
				const x = (event.clientX / window.innerWidth - 0.5) * 12;
				const y = (event.clientY / window.innerHeight - 0.5) * 12;
				heroMolecule.style.transform = `translate(${x}px, ${y}px)`;
			}, { passive: true });
		}

		document.querySelectorAll('.opt-tilt').forEach((card) => {
			card.addEventListener('mousemove', (event) => {
				const rect = card.getBoundingClientRect();
				const x = ((event.clientX - rect.left) / rect.width - 0.5) * 5;
				const y = ((event.clientY - rect.top) / rect.height - 0.5) * -5;
				card.style.transform = `perspective(1000px) rotateX(${y}deg) rotateY(${x}deg) translateY(-2px)`;
			});

			card.addEventListener('mouseleave', () => {
				card.style.transform = '';
			});
		});
	} else {
		document.querySelectorAll('.opt-reveal, .opt-reveal-stagger').forEach((node) => {
			node.classList.add('is-in');
		});
	}
}());

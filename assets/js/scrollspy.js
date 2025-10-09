/* Scrollspy for secondary sticky nav summary buttons
 * Highlights the nav button whose target section is currently in view.
 * Gracefully degrades if IntersectionObserver unsupported.
 */
(function(){
	const nav = document.querySelector('.is-style-section-secondary-sticky-nav');
	if(!nav) return;
	const links = Array.from(nav.querySelectorAll('.is-style-button-summary-nav a[href^="#"]'));
	if(!links.length) return;

	// Map targets
	const targets = links.map(link => {
		try {
			const id = decodeURIComponent(link.getAttribute('href').split('#')[1]);
			if(!id) return null;
			const el = document.getElementById(id);
			return el ? { link, el } : null;
		} catch(e){ return null; }
	}).filter(Boolean);

	if(!targets.length) return;

	// Active class + aria-current utility for accessibility
	const setActive = activeLink => {
		links.forEach(l => {
			const isActive = l === activeLink;
			l.classList.toggle('is-active', isActive);
			if(isActive) {
				// Indicate current in-page location; 'true' acceptable for generic current item
				l.setAttribute('aria-current', 'true');
			} else {
				l.removeAttribute('aria-current');
			}
		});
	};

	// Fallback scroll handler (throttled)
	let ticking = false;
	const fallbackHandler = () => {
		if(ticking) return; ticking = true;
		requestAnimationFrame(() => {
			let closest = null; let closestOffset = Infinity;
			targets.forEach(({link, el}) => {
				const rect = el.getBoundingClientRect();
				const offset = Math.abs(rect.top);
				if(rect.top <= (window.innerHeight * 0.4) && offset < closestOffset){
					closest = link; closestOffset = offset;
				}
			});
			if(closest) setActive(closest);
			ticking = false;
		});
	};

	if('IntersectionObserver' in window) {
		let current = null;
		const observer = new IntersectionObserver(entries => {
			let anyIntersecting = false;
			entries.forEach(entry => {
				if(entry.isIntersecting) {
					anyIntersecting = true;
					const match = targets.find(t => t.el === entry.target);
					if(match && current !== match.link) {
						current = match.link;
						setActive(current);
					}
				}
			});
			// Clear active state if no sections are in view
			if(!anyIntersecting && current !== null) {
				current = null;
				links.forEach(l => {
					l.classList.remove('is-active');
					l.removeAttribute('aria-current');
				});
			}
		},{ rootMargin: '0px 0px -55% 0px', threshold: [0, 0.25, 0.5, 1] });
		targets.forEach(t => observer.observe(t.el));
	} else {
		window.addEventListener('scroll', fallbackHandler, { passive: true });
		fallbackHandler();
	}

	// Smooth scroll enhancement (native if supported)
	const focusTargetElement = (el) => {
		if(!el) return;
		// Prefer heading inside the section, else the section itself
		let focusEl = el.querySelector('h1, h2, h3, h4, h5, h6');
		if(!focusEl) focusEl = el;
		// Make sure element is focusable
		const needsTabindex = !focusEl.hasAttribute('tabindex') && !/^(A|BUTTON|INPUT|TEXTAREA|SELECT)$/.test(focusEl.tagName);
		if(needsTabindex) focusEl.setAttribute('tabindex','-1');
		focusEl.focus({ preventScroll: true });
	};

	links.forEach(link => link.addEventListener('click', e => {
		const hash = link.getAttribute('href');
		if (!hash || hash.charAt(0) !== '#') return;
		const id = decodeURIComponent(hash.substring(1));
		const target = document.getElementById(id);
		if (target) {
			e.preventDefault();
			// Smooth scroll then shift focus
			target.scrollIntoView({ behavior: 'smooth', block: 'start' });
			// Delay focus to allow scroll animation; 300ms typical
			setTimeout(() => {
				focusTargetElement(target);
				// Remove focus from the clicked nav link so its focus style doesn’t persist
				link.blur();
			}, 300);
		}
	}));
})();

(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		initMobileNav();
		initDropdowns('.primary-nav .menu-item.has-children');
		initDropdowns('.mobile-nav .mobile-menu-item.has-children', true);
		initFavoriteButtons();
		initCatalogFilters();
		initCarousels();
		initAccordions();
	});

	function initAccordions() {
		document.querySelectorAll('[data-accordion]').forEach(function (item) {
			var toggle = item.querySelector('[data-accordion-toggle]');
			var panel = item.querySelector('[data-accordion-panel]');
			if (!toggle || !panel) return;

			toggle.addEventListener('click', function () {
				var isOpen = item.classList.contains('is-open');
				item.classList.toggle('is-open', !isOpen);
				toggle.setAttribute('aria-expanded', String(!isOpen));
			});
		});
	}

	function initCarousels() {
		document.querySelectorAll('[data-carousel]').forEach(function (carousel) {
			var track = carousel.querySelector('.carousel__track');
			var prevBtn = carousel.querySelector('[data-carousel-prev]');
			var nextBtn = carousel.querySelector('[data-carousel-next]');
			if (!track || !prevBtn || !nextBtn) return;

			function scrollByItem(direction) {
				var item = track.querySelector('.carousel__item');
				var amount = item ? item.getBoundingClientRect().width + 20 : track.clientWidth * 0.8;
				track.scrollBy({ left: direction * amount, behavior: 'smooth' });
			}

			prevBtn.addEventListener('click', function () { scrollByItem(-1); });
			nextBtn.addEventListener('click', function () { scrollByItem(1); });
		});
	}

	function initCatalogFilters() {
		document.querySelectorAll('.catalog-filters select').forEach(function (select) {
			select.addEventListener('change', function () {
				select.form.submit();
			});
		});
	}

	function initFavoriteButtons() {
		document.querySelectorAll('.product-card__favorite').forEach(function (btn) {
			btn.addEventListener('click', function () {
				var pressed = btn.getAttribute('aria-pressed') === 'true';
				btn.setAttribute('aria-pressed', String(!pressed));
			});
		});
	}

	function initMobileNav() {
		var toggle = document.querySelector('.nav-toggle');
		var panel = document.getElementById('mobile-nav');
		if (!toggle || !panel) return;

		toggle.addEventListener('click', function () {
			var isOpen = toggle.getAttribute('aria-expanded') === 'true';
			toggle.setAttribute('aria-expanded', String(!isOpen));
			panel.classList.toggle('is-open', !isOpen);
			document.body.style.overflow = !isOpen ? 'hidden' : '';
		});
	}

	function initDropdowns(selector, closeOthersWithinSameParentOnly) {
		var items = document.querySelectorAll(selector);
		if (!items.length) return;

		items.forEach(function (item) {
			var trigger = item.querySelector(':scope > button');
			if (!trigger) return;

			trigger.addEventListener('click', function () {
				var isOpen = item.classList.contains('is-open');

				items.forEach(function (other) {
					other.classList.remove('is-open');
					var otherTrigger = other.querySelector(':scope > button');
					if (otherTrigger) otherTrigger.setAttribute('aria-expanded', 'false');
				});

				if (!isOpen) {
					item.classList.add('is-open');
					trigger.setAttribute('aria-expanded', 'true');
				}
			});
		});

		// Cierra dropdowns de desktop al hacer click fuera.
		document.addEventListener('click', function (e) {
			items.forEach(function (item) {
				if (!item.contains(e.target)) {
					item.classList.remove('is-open');
					var trigger = item.querySelector(':scope > button');
					if (trigger) trigger.setAttribute('aria-expanded', 'false');
				}
			});
		});
	}
})();

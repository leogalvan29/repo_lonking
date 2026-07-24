(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		initGallery();
		initTabs();
		initShareAndPrint();
		initQuoteModal();
	});

	function initGallery() {
		var mainImage = document.getElementById('product-main-image');
		var thumbs = document.querySelectorAll('.product-hero__thumb');
		if (!mainImage || !thumbs.length) return;

		thumbs.forEach(function (thumb) {
			thumb.addEventListener('click', function () {
				var full = thumb.getAttribute('data-full');
				if (!full) return;
				mainImage.src = full;
				thumbs.forEach(function (t) { t.classList.remove('is-active'); });
				thumb.classList.add('is-active');
			});
		});
	}

	function initTabs() {
		var links = document.querySelectorAll('.product-tabs__link');
		var panes = document.querySelectorAll('.product-tabs__pane');
		if (!links.length) return;

		links.forEach(function (link) {
			link.addEventListener('click', function () {
				var target = link.getAttribute('data-tab');

				links.forEach(function (l) {
					l.classList.remove('is-active');
					l.setAttribute('aria-selected', 'false');
				});
				panes.forEach(function (p) { p.classList.remove('is-active'); });

				link.classList.add('is-active');
				link.setAttribute('aria-selected', 'true');

				var pane = document.querySelector('.product-tabs__pane[data-pane="' + target + '"]');
				if (pane) pane.classList.add('is-active');
			});
		});
	}

	function initShareAndPrint() {
		var shareBtn = document.querySelector('.js-share');
		var printBtn = document.querySelector('.js-print');

		if (shareBtn) {
			shareBtn.addEventListener('click', function () {
				var shareData = {
					title: document.title,
					url: window.location.href,
				};

				if (navigator.share) {
					navigator.share(shareData).catch(function () {});
				} else if (navigator.clipboard) {
					navigator.clipboard.writeText(window.location.href);
					shareBtn.querySelector('span').textContent = 'Enlace copiado';
					setTimeout(function () {
						shareBtn.querySelector('span').textContent = 'Compartir';
					}, 2000);
				}
			});
		}

		if (printBtn) {
			printBtn.addEventListener('click', function () {
				window.print();
			});
		}
	}

	function initQuoteModal() {
		var modal = document.getElementById('quote-modal');
		if (!modal) return;

		var openButtons = document.querySelectorAll('.js-open-quote');
		var closeButtons = modal.querySelectorAll('.js-close-quote');
		var equipmentField = modal.querySelector('[data-quote-equipment-field]');
		var equipmentLabel = modal.querySelector('[data-quote-equipment-label]');

		openButtons.forEach(function (btn) {
			btn.addEventListener('click', function () {
				var productName = btn.getAttribute('data-product-name') || '';
				if (equipmentField) equipmentField.value = productName;
				if (equipmentLabel) equipmentLabel.textContent = productName ? 'Equipo: ' + productName : '';

				modal.classList.add('is-open');
				modal.setAttribute('aria-hidden', 'false');
				document.body.classList.add('has-quote-modal-open');
			});
		});

		closeButtons.forEach(function (btn) {
			btn.addEventListener('click', closeModal);
		});

		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && modal.classList.contains('is-open')) closeModal();
		});

		function closeModal() {
			modal.classList.remove('is-open');
			modal.setAttribute('aria-hidden', 'true');
			document.body.classList.remove('has-quote-modal-open');
		}
	}
})();

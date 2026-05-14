/* Mitsue admin — repeater rows + media picker */
document.addEventListener('DOMContentLoaded', () => {

	/* ── Add row ─────────────────────────────────────────────── */
	document.querySelectorAll('.mitsue-add-row').forEach(btn => {
		btn.addEventListener('click', () => {
			const wrap  = btn.closest('.mitsue-repeater');
			const tbody = wrap.querySelector('tbody');
			const tpl   = wrap.querySelector('.mitsue-row-tpl');
			const idx   = tbody.querySelectorAll('tr').length;
			const html  = tpl.innerHTML.replaceAll('__IDX__', idx);
			const tr    = document.createElement('tr');
			tr.innerHTML = html;
			tbody.appendChild(tr);
			bindRemove(tr.querySelector('.mitsue-remove-row'));
			tr.querySelectorAll('.mitsue-media-pick-row').forEach(bindMediaPickRow);
		});
	});

	/* ── Remove row ──────────────────────────────────────────── */
	document.querySelectorAll('.mitsue-remove-row').forEach(bindRemove);

	function bindRemove(btn) {
		if (!btn) return;
		btn.addEventListener('click', () => {
			const tbody = btn.closest('tbody');
			btn.closest('tr').remove();
			reindex(tbody);
		});
	}

	function reindex(tbody) {
		tbody.querySelectorAll('tr').forEach((tr, i) => {
			tr.querySelectorAll('[name]').forEach(el => {
				el.name = el.name.replace(/\[([^\]]+)\]\[([^\]]+)\]$/, `[${i}][$2]`);
			});
		});
	}

	/* ── Media library picker (standalone fields) ───────────── */
	document.querySelectorAll('.mitsue-media-pick').forEach(btn => {
		btn.addEventListener('click', () => {
			const targetId = btn.dataset.target;
			const frame = wp.media({
				title:    'Select image',
				button:   { text: 'Use this image' },
				multiple: false,
			});
			frame.on('select', () => {
				const att   = frame.state().get('selection').first().toJSON();
				const input = document.getElementById(targetId);
				if (!input) return;
				input.value = att.url;
				let preview = input.closest('.mitsue-image-field').querySelector('.mitsue-img-preview');
				if (!preview) {
					preview = document.createElement('img');
					preview.className = 'mitsue-img-preview';
					input.closest('.mitsue-image-field').appendChild(preview);
				}
				preview.src = att.url;
				preview.style.display = 'block';
			});
			frame.open();
		});
	});

	/* ── Media picker inside repeater rows ───────────────────── */
	document.querySelectorAll('.mitsue-media-pick-row').forEach(bindMediaPickRow);

	function bindMediaPickRow(btn) {
		if (!btn) return;
		btn.addEventListener('click', () => {
			const field = btn.closest('.mitsue-image-field');
			const input = field.querySelector('input[type="url"]');
			const frame = wp.media({
				title:    'Select image',
				button:   { text: 'Use this image' },
				multiple: false,
			});
			frame.on('select', () => {
				const att   = frame.state().get('selection').first().toJSON();
				input.value = att.url;
				let preview = field.querySelector('.mitsue-img-preview');
				if (!preview) {
					preview           = document.createElement('img');
					preview.className = 'mitsue-img-preview';
					preview.style.cssText = 'margin-top:6px;max-width:80px;display:block;';
					field.appendChild(preview);
				}
				preview.src           = att.url;
				preview.style.display = 'block';
			});
			frame.open();
		});
	}

});

/* Mitsue lightbox — zero dependencies */
(function () {

  /* ── Build overlay ───────────────────────────────────────── */
  const overlay = document.createElement('div');
  overlay.id = 'mitsue-lb';
  overlay.innerHTML =
    '<div id="mitsue-lb-inner">' +
      '<img id="mitsue-lb-img" alt="" />' +
      '<button id="mitsue-lb-close" aria-label="Close">&#x2715;</button>' +
    '</div>';
  document.body.appendChild(overlay);

  const lbImg   = document.getElementById('mitsue-lb-img');
  const lbClose = document.getElementById('mitsue-lb-close');

  function open(url, alt) {
    lbImg.src = url;
    lbImg.alt = alt || '';
    overlay.classList.add('active');
    document.body.style.overflow = 'hidden';
  }

  function close() {
    overlay.classList.remove('active');
    document.body.style.overflow = '';
    lbImg.src = '';
  }

  overlay.addEventListener('click', e => {
    if (e.target === overlay || e.target === document.getElementById('mitsue-lb-inner') || e.target === lbClose) close();
  });

  document.addEventListener('keydown', e => { if (e.key === 'Escape') close(); });

  /* ── Auto-mark images on load ────────────────────────────── */
  document.addEventListener('DOMContentLoaded', () => {

    /* Portrait photos and section-img: read src directly */
    document.querySelectorAll('.portrait img, img.section-img').forEach(img => {
      if (img.src) {
        img.dataset.lightboxUrl = img.src;
        img.dataset.lightboxAlt = img.alt || '';
        img.classList.add('mitsue-lb-trigger');
      }
    });

    /* Imagery panels: background-image divs with data-lightbox-url */
    document.querySelectorAll('[data-lightbox-url]').forEach(el => {
      el.classList.add('mitsue-lb-trigger');
    });
  });

  /* ── Click handler (delegated) ───────────────────────────── */
  document.addEventListener('click', e => {
    const el = e.target.closest('.mitsue-lb-trigger');
    if (!el) return;
    e.preventDefault();
    const url = el.dataset.lightboxUrl || el.src;
    const alt = el.dataset.lightboxAlt || el.alt || '';
    if (url) open(url, alt);
  });

})();

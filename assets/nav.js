(function () {
  var toggle = document.querySelector('.nav-toggle');
  var nav = document.querySelector('nav.primary');
  if (!toggle || !nav) return;

  toggle.addEventListener('click', function () {
    var open = nav.classList.toggle('nav-open');
    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
  });

  nav.querySelectorAll('.navlinks a').forEach(function (a) {
    a.addEventListener('click', function () {
      nav.classList.remove('nav-open');
      toggle.setAttribute('aria-expanded', 'false');
    });
  });
})();

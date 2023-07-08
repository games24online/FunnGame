window.addEventListener('DOMContentLoaded', () => {
  // **** Show mobile menu **** //
  (function () {
    const btnMenu = document.querySelector('.nav-icon');
    const menu = document.querySelector('.menu');
    const links = document.querySelectorAll('.menu__link');

    btnMenu.addEventListener('click', function () {
      this.classList.toggle('close');
      menu.classList.toggle('show-menu');
      document.body.classList.toggle('hidden');
    });

    links.forEach(item => {
      item.addEventListener('click', () => {
        btnMenu.classList.remove('close');
        menu.classList.remove('show-menu');
        document.body.classList.remove('hidden');
      });
    });
  })();

  $btnNext.on('click', function () {
    renderStep(++currentStep);
  });
  let e = $('.wp-block-button__link').attr('href'),
    t = window.location.search,
    i = new URLSearchParams(t);
  $('.wp-block-button__link').each(function () {
    $(this).attr('href', e + '?k1=' + i.get('k1') + '&k2=' + i.get('k1'));
  });
});

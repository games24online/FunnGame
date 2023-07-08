$(document).ready(function () {
  function getCookie(name) {
    var v = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)')
    return v ? v[2] : null
  }

  function setCookie(name, value, days) {
    var d = new Date
    d.setTime(d.getTime() + 24 * 60 * 60 * 1000 * days)
    document.cookie = name + '=' + value + ';path=/;expires=' + d.toGMTString()
  }

  function initCookieWarning() {

    var msg = $('.cookies');
    var footer = $('footer').outerHeight();
    $('.cookies__ok').on('click', function () {
      setCookie('warning-cookies', 1, 999999999)
      msg.css('display', 'none')
    })
    if (!getCookie('warning-cookies')) {
      msg.css({ 'display': 'flex', 'bottom': footer });
    }
  }
  initCookieWarning();
});

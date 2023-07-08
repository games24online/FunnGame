let $btnNext = $(".step-content:not(:last) LI");
let currentStep = 1;
let $step = $(".step-item");

let $window = $(window);
let lastWidth = $(window).width();
let currentViewport;
let initialViewport;

$(document).ready(function () {
  $btnNext.on("click", function () {
    currentStep++;
    // if (currentStep === 18) {
    //   $("header, footer").hide();
    // }
    renderStep(currentStep);
  });
});

renderStep(currentStep);

function renderStep(n) {
  let container = $(".step" + n + "");
  $(".step-item").hide();
  container.fadeIn().css("display", "flex");
}

function resize() {
  if (window.matchMedia("(orientation: portrait)").matches) {
    currentViewport = "portrait";
  } else currentViewport = "landscape";

  if (
    typeof initialViewport !== "undefined" &&
    initialViewport !== currentViewport
  ) {
    initialViewport = currentViewport;
  }
}

$window
  .resize(function () {
    if ($(window).width() != lastWidth) {
      resize();
      lastWidth = $(window).width();
    }
  })
  .trigger("resize");

  //! =========== Function resize =========== //
let vh = window.innerHeight * 0.01;
document.documentElement.style.setProperty('--vh', `${vh}px`);

(function init100vh() {
	function setHeight() {
		var vh = window.innerHeight * 0.01;
		document.documentElement.style.setProperty('--vh', `${vh}px`);
	}
	setHeight();
	window.addEventListener('resize', setHeight);
})();
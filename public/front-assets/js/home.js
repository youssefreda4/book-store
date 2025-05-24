document.addEventListener("DOMContentLoaded", function () {
  initMainSlider();
  initSaleSlider();
});

function initMainSlider() {
  const direction = document.documentElement.dir === "rtl" ? "rtl" : "ltr";

  const splide = new Splide(".splide", {
    type: "loop",
    direction: direction,
    interval: 0,
    gap: "20px",
    autoplay: true,
    drag: true,
    focus: "center",
    perPage: 8,
    perMove: 2,
    speed: 10000,
    easing: "linear",
    arrows: false,
    pagination: false,
    padding: "5rem",
    autoScroll: {
      speed: 1,
    },
    breakpoints: {
      1200: { perPage: 2, gap: "1rem" },
      640: { gap: 0 },
    },
  });

  splide.mount(window.splide?.Extensions || {});
}

function initSaleSlider() {
  const direction = document.documentElement.dir === "rtl" ? "rtl" : "ltr";

  const saleSlider = new Splide("#saleSlider", {
    direction: direction,
    perPage: 2,
    gap: 20,
    focus: "center",
    omitEnd: true,
    arrows: true,
    pagination: false,
    perMove: 1,
    padding: "0rem",
    breakpoints: {
      1200: { perPage: 1, gap: "1rem", arrows: false },
      640: { gap: 0, arrows: false },
    },
  });

  saleSlider.mount();
}

function recreateSliders() {
  const oldMain = document.querySelector(".splide");
  if (oldMain?.splide) {
    oldMain.splide.destroy(true);
  }

  const oldSale = document.querySelector("#saleSlider");
  if (oldSale?.splide) {
    oldSale.splide.destroy(true);
  }

  initMainSlider();
  initSaleSlider();
}

document.querySelector("#langToggle")?.addEventListener("click", function () {
  const html = document.documentElement;

  if (html.lang === "en") {
    html.lang = "ar";
    html.dir = "rtl";
  } else {
    html.lang = "en";
    html.dir = "ltr";
  }

  recreateSliders();
});

function updateRangeColor(input) {
  const value = ((input.value - input.min) / (input.max - input.min)) * 100;
  input.style.background = `linear-gradient(to right, #eaa451 ${value}%, #ffffff1a ${value}%)`;
}

 document.querySelectorAll('.recommended_card__rate').forEach(rateDiv => {
  const rate = parseFloat(rateDiv.getAttribute('data-rate')) || 0;
  const stars = rateDiv.querySelectorAll('.stars-container i');
  const rateValueEl = rateDiv.querySelector('.rate-value');

  if (rateValueEl) {
    rateValueEl.textContent = rate.toFixed(2);
  }

  stars.forEach((star, index) => {
    const starNumber = index + 1;

    if (rate >= starNumber) {
      star.classList.add('text-warning');
      star.classList.remove('text-secondary');
      star.classList.replace('fa-star-half-alt', 'fa-star');
    } else if (rate + 0.5 >= starNumber) {
      star.classList.add('text-warning');
      star.classList.remove('text-secondary');
      star.classList.replace('fa-star', 'fa-star-half-alt');
    } else {
      star.classList.add('text-secondary');
      star.classList.remove('text-warning', 'fa-star-half-alt');
      star.classList.replace('fa-star-half-alt', 'fa-star');
    }
  });
});



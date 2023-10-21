// FONCTIONS

function onClickNextBtn(event) {
  event.preventDefault();
  slideIndex++;
  if (slideIndex == slides.length) {
    slideIndex = 0;
  }
  refresh();
}

function onClickPrevBtn(event) {
  event.preventDefault();
  slideIndex--;
  if (slideIndex == -1) {
    slideIndex = slides.length - 1;
  }
  refresh();
}

function refresh() {
  const activeSlide = document.querySelector(".slider-figure.active");
  activeSlide.classList.remove("active");
  slides[slideIndex].classList.add("active");
}

// CODE PRINCIPAL

const slides = document.querySelectorAll(".slider-figure");
let slideIndex = 0;
const nextBtn = document.getElementById("next");
const prevBtn = document.getElementById("prev");

nextBtn.addEventListener("click", onClickNextBtn);
prevBtn.addEventListener("click", onClickPrevBtn);

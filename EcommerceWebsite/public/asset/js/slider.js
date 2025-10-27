// Slider
let currentSlide = 0;
const slides = document.querySelectorAll(".slide");

function showSlide(index) {
  slides.forEach((slide, i) => (slide.style.display = i === index ? "block" : "none"));
}

function nextSlide() {
  currentSlide = (currentSlide + 1) % slides.length;
  showSlide(currentSlide);
}

function prevSlide() {
  currentSlide = (currentSlide - 1 + slides.length) % slides.length;
  showSlide(currentSlide);
}

document.addEventListener("DOMContentLoaded", () => showSlide(currentSlide));

// Mobile Menu Toggle
function toggleMenu() {
  document.querySelector(".menu").classList.toggle("active");
}
// </script>
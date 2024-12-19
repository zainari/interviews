// script.js
let slideIndex = 0;

function showSlide(index) {
    const slides = document.querySelectorAll('.sliderItem');
    const totalSlides = slides.length;

    // Ensure index is within bounds
    if (index >= totalSlides) {
        slideIndex = 0;
    } else if (index < 0) {
        slideIndex = totalSlides - 1;
    } else {
        slideIndex = index;
    }

    const offset = -slideIndex * 100 / totalSlides; // Calculate the offset for transform
    document.querySelector('.sliderwrapper').style.transform = `translateX(${offset}%)`;
}

function nextSlide() {
    showSlide(slideIndex + 1);
}

function prevSlide() {
    showSlide(slideIndex - 1);
}

// Show the first slide initially
showSlide(slideIndex);




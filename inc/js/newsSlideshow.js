var slideIndex = 1;
showSlides(slideIndex);
setInterval(plusSlides.bind(this,1), 6000); //Auto slide)


function plusSlides(n) { //React to the onclick event set in news.php mine 38-39
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) { //In this case, n for slideIndex value
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1} //Back to the beginning of the slide loop
    if (n < 1) {slideIndex = slides.length} //Go to the end of the slide loop
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none"; //hiding all the inactives slides
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", ""); // Turning dots off
    }
    slides[slideIndex-1].style.display = "block"; //Display Slide
    dots[slideIndex-1].className += " active"; // Turning the right dot on
}



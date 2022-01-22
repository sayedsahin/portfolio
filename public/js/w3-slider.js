var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("w3-mySlides");
  var dots = document.getElementsByClassName("w3-demo");
  // var captionText = document.getElementById("w3-caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" w3-active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " w3-active";
  // captionText.innerHTML = dots[slideIndex-1].alt;
}
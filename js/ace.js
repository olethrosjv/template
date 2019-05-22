/*weather*/

locationFinder();
apiCall();

// Unit changer (F to C, vice versa). Tagged to body due to API
$("#weather-feed").on("click", "#change", function (e) {
  if (unit === "F") {
    temperature = (temperature - 32) * 5 / 9;
    unit = "C";
    $("#change").html(Math.round(temperature) + "&#176;" + unit);
  } else if (unit === "C") {
    temperature = temperature * 9 / 5 + 32;
    unit = "F";
    $("#change").html(Math.round(temperature) + "&#176;" + unit);
  }
  e.preventDefault();
});

// Initial definition of global variables
var temperature, city, unit, fullLocation, apiLink = "";

function locationFinder() {
  $.getJSON("https://ipinfo.io/geo").done(function (response) {
    city = response.city; // Leave here, needs to be filled for Weather API
    fullLocation = response.city + ", " + response.region;
  }).fail(error);
}

// Waits for city to fill before it calls the if
function apiCall() {
  if (typeof city !== "undefined") {
    apiLink = "https://api.apixu.com/v1/current.json?key=5cb736ef916f42e79c2183020171108&q=" + city;
    $.getJSON(apiLink).done(update).fail(error);

    function update(response) {

      // Units are F, initial setting. &units=imperial
      unit = "F";
      var description = response.current.condition.text;
      temperature = Math.round(response.current.temp_f);

      var iconLink = "https://" + response.current.condition.icon;

      $("#city").html("<h4>" + fullLocation + "</h4>");
      $("#description").html(description + " | " + "<a href='#' id='change'>" + temperature + "&#176;" + unit + "</a>");
      $("#icon").html('<img src="' + iconLink + '">');
    }
  } else {
    setTimeout(apiCall, 100);
  }
}

// Only runs when JSON fails or server responds with anything other than expected
function error() {
  $("#city").html("There has been an error.</br>Try again later!");
  $("#description").html("");
}


// new slideshow


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
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {
    slideIndex = 1
  }
  if (n < 1) {
    slideIndex = slides.length
  }
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex - 1].style.display = "block";
  dots[slideIndex - 1].className += " active";
}
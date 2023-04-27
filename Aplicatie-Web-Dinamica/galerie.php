<?php
include "header.html";
?>
<p class = "currentPage">Galerie</p>
<p id ="titluGalerie">Ne face placere sa va prezentam cateva poze cu noi pe scena!</p>
<div class="slideshow">
  <img class="galerie" id = "poza1" src="galerie/trupa1.jpg">
  <img class="galerie" id = "poza2"src="galerie/trupa2.jpg">
  <img class="galerie"  id ="poza3" src="galerie/trupa3.jpg">
</div>

<button id="galerieNextButton" onclick="changePhoto(1)">></button>
<button id="galeriePrevButton" onclick="changePhoto(-1)"><</button>

<script>

var indexPoza = 1;

function changePhoto(value = 0){
    var idc = "poza" + indexPoza;
    var pozaCurenta = document.getElementById(idc);
    pozaCurenta.style.display = "none";

    if(indexPoza + value <= 0) indexPoza = 3;
    else if(indexPoza + value > 3) indexPoza = 1;
    else indexPoza += value;

    var idn = "poza" + indexPoza;
    var pozaCurenta = document.getElementById(idn);
    pozaCurenta.style.display = "unset";
}

changePhoto();


</script>


<?php
include "footer.html";
?>
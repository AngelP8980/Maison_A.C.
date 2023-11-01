// FONCTIONS

function onClickNextBtn(event) {
  event.preventDefault(); // Annule le comportement par défaut du clic
  slideIndex++; // Incrémente le bouton suivant de 1
  if (slideIndex == slides.length) {
    // Si slideIndex atteint la fin de la liste des photos
    slideIndex = 0; // alors réinitialisation à 0 pour afficher le 1ère photo
  }
  refresh(); // Appelle la fonction refresh
}

function onClickPrevBtn(event) {
  event.preventDefault(); // Annule le comportement par défaut du clic
  slideIndex--; // Décrémente le bouton précédent de 1
  if (slideIndex == -1) {
    // si slideIndex devient -1, signifie que la 1ère photo est active
    slideIndex = slides.length - 1; // alors réinitialisation pour afficher la dernière photo
  }
  refresh(); // Appelle la fonction refresh
}

function refresh() {
  // Mise à jour de l'affichage du carrousel
  const activeSlide = document.querySelector(".slider-figure.active"); // Sélectionne la photo actuellement active en cherchant l'élément HTML avec la classe 'slider-figure' et la classe 'active'
  activeSlide.classList.remove("active"); // Supprime la classe 'active' de la photo (désactivation de la photo)
  slides[slideIndex].classList.add("active"); // Ajoute la classe 'active' à la photo qui correspond à l'indice actuel de slideIndex, ce qui la rend active et l'affiche à l'écran
}

// CODE PRINCIPAL

const slides = document.querySelectorAll(".slider-figure"); // Contient toutes les photos
let slideIndex = 0; // Suit l'indice de la photo actuellement affichée (let peut être réaffectée uniquement dans le bloc où elle a été déclarée)
const nextBtn = document.getElementById("next"); // Eléments HTML bouton 'suivant'
const prevBtn = document.getElementById("prev"); // Eléments HTML bouton 'préédent'

nextBtn.addEventListener("click", onClickNextBtn); // Ecouteurs d'évènements btn 'suivant' qui au clic, appelle la fonction onClickNextBtn (gestion de la nav dans carrousel)
prevBtn.addEventListener("click", onClickPrevBtn); // Ecouteurs d'évènements btn 'précédent' qui au clic, appelle la fonction onClickPrevBtn (gestion de la nav dans carrousel)

// Récupération des éléments HTML
const carouselContainer = document.querySelector(".carouselExampleIndicators");
const prevBtn = document.getElementById("prevBtn");
const nextBtn = document.getElementById("nextBtn");

// Tableau des images
const images = ["image1.jpg", "image2.jpg", "image3.jpg"];
let currentIndex = 0;

// Fonction pour afficher l'image suivante
function showNextImage() {
  currentIndex = (currentIndex + 1) % images.length;
  updateCarousel();
}

// Fonction pour afficher l'image précédente
function showPreviousImage() {
  currentIndex = (currentIndex - 1 + images.length) % images.length;
  updateCarousel();
}

// Fonction pour mettre à jour le carrousel
function updateCarousel() {
  const imageUrl = images[currentIndex];
  carouselContainer.style.backgroundImage = `url(${imageUrl})`;
}

// Écouteurs d'événements pour les boutons
nextBtn.addEventListener("click", showNextImage);
prevBtn.addEventListener("click", showPreviousImage);

// Affiche la première image au chargement de la page
updateCarousel();

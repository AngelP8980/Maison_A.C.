// Fonction de suppression
function onClickDeleteButton(event) {
  // Ecouteur d'évènement (clic)
  event.preventDefault(); //Annule le comportement par défaut du clic

  if (confirm("Etes-vous sûr de vouloir supprimer cette technique ?")) {
    const url = event.currentTarget.href; // Récupère l'url sur lequel il y a l'évènement
    fetch(url)
      .then(function (response) {
        // Requête HTTP via fetch vers l'url (GET)
        return response.json(); // Réponse du serveur en JSON
      })
      .then(function (data) {
        // Traitement des données json en extrayant la valeur de la clé id de la technique
        const id = data.id; // Récupère l'id de la technique
        const tr = document.querySelector(`[data-id="${id}"]`); // Stocke la valeur de l'id dans la variable tr
        tr.remove(); // Effectue l'action de supprimer en réponse au clic
        console.log(id);
      });
  }
}
// Attacher cet écouteur d'évènement au bouton supprimer (ajout d'un gestionnaire d'évènements de clic)
const deleteButtons = document.querySelectorAll(".delete-button"); // Sélectionne les éléments du DOM ayant la classe "delete-button"
console.log(deleteButtons);
for (const button of deleteButtons) {
  // Boucle Forof permet de parcourir tous les boutons de suppression trouvés
  button.addEventListener("click", onClickDeleteButton); // Ajoute un écouteur d'évènement de clic pour chaque bouton.
  //La fonction "onclickDeleteButton" sera appelée lorsque l'utilisateur clique sur l'un des boutons supprimer
  console.log("click");
}

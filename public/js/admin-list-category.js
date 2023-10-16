// Fonction de suppression
function onClickDeleteButton(event) {
  // Ecouteur d'évènement (clic)
  event.preventDefault(); // Annule le comportement par défaut du clic

  console.log(event);

  if (confirm("Etes-vous sûr de vouloir supprimer cette catégorie ?")) {
    // event.currentTarget correspond à l'élément du dom déclencheur de l'évènement (bouton suppr)
    // href correspond à l'attribut href dans le phtml
    const url = event.currentTarget.href; // Récupère l'url sur lequel il y a l'évènement - va chercher la valeur de l'élément sur lequel on click

    fetch(url) // Envoi de la requête http vers l'url de suppr
      .then(function (response) {
        // Requête HTTP via fetch vers l'url (GET)
        return response.json(); // Réponse du serveur en JSON
      })
      .then(function (data) {
        // data : réponse qui est renvoyée en json dans php (echo du fichier php)
        // Traitement des données json en extrayant la valeur de la clé id de la catégorie

        const id = data.id; // Récupère l'id de la catégorie
        const tr = document.querySelector(`[data-id="${id}"]`); // Stocke la valeur de l'id dans la variable tr

        tr.remove(); // Effectue l'action de supprimer en réponse au clic
      });
  }
}
// Attacher cet écouteur d'évènement au bouton supprimer (ajout d'un gestionnaire d'évènements de clic)
const deleteButtons = document.querySelectorAll(".delete-button"); // Sélectionne les éléments du DOM ayant la classe "delete-button"

for (const button of deleteButtons) {
  // Boucle Forof permet de parcourir tous les boutons de suppression trouvés

  button.addEventListener("click", onClickDeleteButton); // Ajoute un écouteur d'évènement de clic pour chaque bouton.
  //La fonction "onclickDeleteButton" sera appelée lorsque l'utilisateur clique sur l'un des boutons supprimer
}

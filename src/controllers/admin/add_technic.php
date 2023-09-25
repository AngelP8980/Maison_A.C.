<?php 

// Import de classes
use App\Model\TechnicModel;

// Flash messages
$flashMessage = fetchFlash("La technique a bien été créée");

// Initialisations
const PASSWORD_MIN_LENGTH = 8; // Longueur minimale du mot de passe

$errors = []; // Tableau qui contiendra les erreurs

$title_technic = '';


// Si le formulaire est soumis...
if (!empty($_POST)) {

    // 1. Récupération des champs du formulaire dans des variables
    $title_technic = trim($_POST['title_technic']);
   

    // 2. Validation des données du formulaire
    if (!$title_technic) {
        $errors['title_technic'] = 'Le champ "titre de la technique" est obligatoire';
    }

    
    $technicModel = new TechnicModel();
    if ($technicModel->getTechnicByTitle($title_technic)) {
        $errors['title_technic'] = 'Il existe déjà une technique associée à ce titre';
    }

    // Si aucune erreur... 
    if (empty($errors)) {

        // Insertion de la technique en base de données
        $technicModel->insertTechnic($title_technic);

        // Message flash
        addFlash('La technique a bien été créée').

        // Redirection
        header('Location: /admin/technic/add');
        exit;
    }
}

// Affichage : inclusion du template
$template = 'admin/add_technic';
include '../templates/admin/base.phtml';

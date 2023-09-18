<?php 

// Import de classes
use App\Model\UserModel;

// Initialisations
const PASSWORD_MIN_LENGTH = 8; // Longueur minimale du mot de passe

$errors = []; // Tableau qui contiendra les erreurs

$title = '';


// Si le formulaire est soumis...
if (!empty($_POST)) {

    // 1. Récupération des champs du formulaire dans des variables
    $title = trim($_POST['title']); 
   

    // 2. Validation des données du formulaire
    if (!$title) {
        $errors['title'] = 'Le champ "titre" est obligatoire';
    }

    
    $userModel = new UserModel();
    if ($userModel->getUserByEmail($title)) {
        $errors['title'] = 'Il existe déjà une catégorie associée à ce titre';
    }

    // Si aucune erreur... 
    if (empty($errors)) {

        // Insertion de la catégorie en base de données
        $categoryModel->insertCategory($title);

        // Message flash
        addFlash('La catégorie a bien été créée').

        // Redirection
        header('Location: /');
        exit;
    }
}

// Affichage : inclusion du template
$template = 'admin/add_category';
include '../templates/admin/base.phtml';

<?php

// Vérification de connexion de l'administrateur
if (!isAdmin()) {
    echo ('Page introuvable');
    exit;
}

// Import de classes
use App\Model\CategoryModel;

// Flash messages
$flashMessage = fetchFlash("La catégorie a bien été créée");

// Initialisations
const PASSWORD_MIN_LENGTH = 8; // Longueur minimale du mot de passe

$errors = []; // Tableau qui contiendra les erreurs

$title_category = '';


// Si le formulaire est soumis...
if (!empty($_POST)) {

    // 1. Récupération des champs du formulaire dans des variables
    $title_category = trim($_POST['title_category']);
    $image = $_POST['image'];


    // 2. Validation des données du formulaire
    if (!$title_category) {
        $errors['title_category'] = 'Le champ "titre de la catégorie" est obligatoire';
    }
    if (!$image) {
        $errors['image'] = 'Le champ "image de la catégorie" est obligatoire';
    }

    $categoryModel = new CategoryModel();
    if ($categoryModel->getCategoryByTitle($title_category)) {
        $errors['title_category'] = 'Il existe déjà une catégorie associée à ce titre';
    }

    // Si aucune erreur... 
    if (empty($errors)) {

        // Insertion de la catégorie en base de données
        $categoryModel->insertCategory($title_category, $image);

        // Message flash
        addFlash('La catégorie a bien été créée') .

            // Redirection
            header('Location: ' . buildUrl('admin_add_category'));
        exit;
    }
}

// Affichage : inclusion du template
$template = 'admin/add_category';
include '../templates/admin/base.phtml';

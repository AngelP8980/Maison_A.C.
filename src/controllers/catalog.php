<?php

// Import de classes
use App\Model\CategoryModel;

$categoryModel = new CategoryModel();

// Récupération et validation de l'id de la catégorie de l'URL (chaîne de requête)
if (!array_key_exists('id_category', $_GET) || !ctype_digit($_GET['id_category'])) {
    echo 'Id de la categorie incorrect';
    exit;
}

// Ici je sais que j'ai bien mon paramètre id dans l'URL et que c'est un nombre
$categoryId = $_GET['id_category'];

// Initialisations
$errors = []; // Tableau qui contiendra les erreurs

// Sélections de la liste des catégories
$categories = $categoryModel->getCategoryAll();

// la catégorie existe-t-elle bien ?
if (!$category) {
    echo 'Catégorie introuvable';
    exit;
}





// Affichage : inclusion du template
$template = 'catalog';
include '../templates/base.phtml';

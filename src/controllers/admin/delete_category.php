<?php

// Vérification de connexion de l'administrateur
if (!isAdmin()) {
    echo ('Page introuvable');
    exit;
}

// Import de classes
use App\Model\CategoryModel;

// Récupération et validation de l'id de la catégorie de l'URL (chaîne de requête)
if (!array_key_exists('id_category', $_GET) || !ctype_digit($_GET['id_category'])) {
    echo 'Id de la catégorie incorrect';
    exit;
}

// Ici je sais que j'ai bien mon paramètre id dans l'URL et que c'est un nombre
$categoryId = $_GET['id_category'];

// Sélection de la catégorie à modifier dans la base de données à partir de son id
$categoryModel = new CategoryModel();
$category = $categoryModel->getOneCategoryById($categoryId);

// la catégorie existe-t-elle bien ?
if (!$category) {
    echo 'Catégorie introuvable';
    exit;
}

// Suppression de la categorie
$categoryModel->deleteCategory($categoryId);

if (file_exists('img/category/' . $category['image'])) {
    unlink('img/category/' . $category['image']);
}

// Message flash
addFlash('La catégorie a bien été supprimée');

// retour JS
echo json_encode(['id' => $categoryId]);

<?php

// Import de classes
use App\Model\CategoryModel;

$categoryModel = new CategoryModel();



// Sélection de la catégorie par son id
$category = $categoryModel->getOneCategoryById($categoryId);

if (!$category) {
    // gère le cas où la catégorie n'existe pas
    echo ('Catégorie introuvable');
    exit;
}



// Affichage : inclusion du template
$template = 'category';
include '../templates/base.phtml';

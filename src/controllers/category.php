<?php

// Import de classes
use App\Model\CategoryModel;
use App\Model\ProductModel;

$productModel = new ProductModel();
$categoryModel = new CategoryModel();


// Récupération et validation de l'id du produit de l'URL (chaîne de requête)
if (!array_key_exists('id_category', $_GET) || !ctype_digit($_GET['id_category'])) {
    echo 'Id de la catégorie incorrect';
    exit;
}

// Ici je sais que j'ai bien mon paramètre id dans l'URL et que c'est un nombre
$categoryId = $_GET['id_category'];


// Sélection de la catégorie par son id
$category = $categoryModel->getOneCategoryById($categoryId);

if (!$category) {
    // gère le cas où la catégorie n'existe pas
    echo ('Catégorie introuvable');
    exit;
}

//  Sélection des produits par leur id
$products = $productModel->getProductsByCategoryId($categoryId);



// Affichage : inclusion du template
$template = 'category';
include '../templates/base.phtml';

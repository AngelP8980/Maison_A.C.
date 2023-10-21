<?php

// Import de classes
use App\Model\CategoryModel;
use App\Model\ProductModel;

$categoryModel = new CategoryModel();
$productModel = new ProductModel();

// Récupération et validation de l'id du produit de l'URL (chaîne de requête)
if (!array_key_exists('id_product', $_GET) || !ctype_digit($_GET['id_product'])) {
    echo 'Id du produit incorrect';
    exit;
}

// Ici je sais que j'ai bien mon paramètre id dans l'URL et que c'est un nombre
$productId = $_GET['id_product'];
$product = $productModel->getOneProductById($productId);

if (!$product) {
    // gère le cas où le produit n'existe pas
    echo ('Produit introuvable');
    exit;
}








// Affichage : inclusion du template
$template = 'product';
include '../templates/base.phtml';

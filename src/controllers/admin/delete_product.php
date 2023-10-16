<?php

// Vérification de connexion de l'administrateur
if (!isAdmin()) {
    echo ('Page introuvable');
    exit;
}

// Import de classes
use App\Model\ProductModel;

// Récupération et validation de l'id du produit de l'URL (chaîne de requête)
if (!array_key_exists('id_product', $_GET) || !ctype_digit($_GET['id_product'])) {
    echo 'Id du produit incorrect';
    exit;
}

// Ici je sais que j'ai bien mon paramètre id dans l'URL et que c'est un nombre
$productId = $_GET['id_product'];

// Sélection du produit à modifier dans la base de données à partir de son id
$productModel = new ProductModel();
$product = $productModel->getOneProductById($productId);

// le produit existe-t-il bien ?
if (!$product) {
    echo 'Produit introuvable';
    exit;
}

// Suppression du produit
$productModel->deleteProduct($productId);

if (file_exists('img/product/' . $product['image'])) {
    unlink('img/product/' . $product['image']);
}

// Message flash
addFlash('Le produit a bien été supprimé');

// retour JS
echo json_encode(['id' => $productId]);

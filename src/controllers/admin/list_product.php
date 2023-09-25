<?php 

// Import de classes
use App\Model\ProductModel;

// Création d'un objet ProductModel
$productModel = new ProductModel();

// Sélections de la liste des produits
$products = $productModel->getProductAll();

// dump($products);

// Récupération du message flash le cas échéant
$flashMessage = fetchFlash();

// Affichage : inclusion du template
$template = 'admin/list_product';
include '../templates/admin/base.phtml';

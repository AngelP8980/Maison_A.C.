<?php

// Import de classes
use App\Model\CategoryModel;

$categoryModel = new CategoryModel();

// Sélections de la liste des catégories
$products = $productModel->getProductById();



// Affichage : inclusion du template
$template = 'product';
include '../templates/base.phtml';

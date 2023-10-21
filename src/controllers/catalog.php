<?php

// Import de classes
use App\Model\CategoryModel;

$categoryModel = new CategoryModel();

// Sélections de la liste des catégories
$categories = $categoryModel->getCategoryAll();







// Affichage : inclusion du template
$template = 'catalog';
include '../templates/base.phtml';

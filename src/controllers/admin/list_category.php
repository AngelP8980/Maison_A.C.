<?php 

// Vérification de connexion de l'administrateur
if (!isAdmin()){
    echo ('Page introuvable');
    exit;
}

// Import de classes
use App\Model\CategoryModel;

// Création d'un objet CategoryModel
$categoryModel = new CategoryModel();

// Sélections de la liste des catégories
$categories = $categoryModel->getCategoryAll();

// dump($categories);

// Récupération du message flash le cas échéant
$flashMessage = fetchFlash();

// Affichage : inclusion du template
$template = 'admin/list_category';
include '../templates/admin/base.phtml';

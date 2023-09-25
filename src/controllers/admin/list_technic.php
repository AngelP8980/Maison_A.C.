<?php 

// Import de classes
use App\Model\TechnicModel;

// Création d'un objet TechnicModel
$technicModel = new TechnicModel();

// Sélections de la liste des techniques
$technics = $technicModel->getTechnicAll();

// dump($technics);

// Récupération du message flash le cas échéant
$flashMessage = fetchFlash();

// Affichage : inclusion du template
$template = 'admin/list_technic';
include '../templates/admin/base.phtml';

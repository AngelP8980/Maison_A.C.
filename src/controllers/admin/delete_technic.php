<?php

// Vérification de connexion de l'administrateur
if (!isAdmin()) {
    echo ('Page introuvable');
    exit;
}

// Import de classes
use App\Model\TechnicModel;

// Récupération et validation de l'id de la technique de l'URL (chaîne de requête)
if (!array_key_exists('id_technic', $_GET) || !ctype_digit($_GET['id_technic'])) {
    echo 'Id de la technique incorrect';
    exit;
}

// Ici je sais que j'ai bien mon paramètre id dans l'URL et que c'est un nombre
$technicId = $_GET['id_technic'];

// Sélection de la technique à modifier dans la base de données à partir de son id
$technicModel = new TechnicModel();
$technic = $technicModel->getOneTechnicById($technicId);

// la technique existe-t-elle bien ?
if (!$technic) {
    echo 'Technique introuvable';
    exit;
}

// Suppression de la technique
$technicModel->deleteTechnic($technicId);

// Message flash
addFlash('La technique a bien été supprimée');

// retour JS
echo json_encode(['id' => $technicId]);

<?php 

// Vérification de connexion de l'administrateur
if (!isAdmin()){
    echo ('Page introuvable');
    exit;
}

// Affichage : inclusion du template
$template = 'admin/admin';
include '../templates/admin/base.phtml';

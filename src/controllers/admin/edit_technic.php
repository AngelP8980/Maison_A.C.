<?php 

// Vérification de connexion de l'administrateur
if (!isAdmin()){
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

// Initialisations
$errors = []; // Tableau qui contiendra les erreurs

// Sélection de la technique à modifier dans la base de données à partir de son id
$technicModel = new TechnicModel();
$technic = $technicModel->getOneTechnicById($technicId);

// la technique existe-t-elle bien ?
if (!$technic) {
    echo 'Technique introuvable';
    exit;
}

// Variables qui vont permettre de pré remplir le formulaire
// avec les valeurs de la technique à modifier
$id = $technic['id_technic'];
$title = $technic['title_technic'];

// Si le formulaire est soumis...
if (!empty($_POST)) {

    // On récupère les données du formulaire
    $title = trim($_POST['title_technic']);
   
    // Validation des données
    if (!$title) {
        $errors['title_technic'] = 'Le champ "titre" est obligatoire';
    }

    // Si pas d'erreurs...
    if (empty($errors)) {

        // Insertion de la technique en base de données
        $technicModel->editTechnic($technicId, $title);

        // Ajouter un message flash
        addFlash('La technique a bien été modifiée.');

        // Redirection 
        header('Location: ' . buildUrl('admin_list_technic'));
        exit;
    }
}

// Affichage du nombre d'instances de PDO
// dump(AbstractModel::getCountPDO());

// Affichage du formulaire : inclusion du fichier de template
$template = 'admin/edit_technic';
include '../templates/admin/base.phtml'; 
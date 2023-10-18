<?php

// Vérification de connexion de l'administrateur
if (!isAdmin()) {
    echo ('Page introuvable');
    exit;
}

// Import de classes
use App\Model\CategoryModel;

$categoryModel = new CategoryModel();


// Flash messages
$flashMessage = fetchFlash("La catégorie a bien été créée");

// Initialisations
const PASSWORD_MIN_LENGTH = 8; // Longueur minimale du mot de passe

$errors = []; // Tableau qui contiendra les erreurs

$title_category = '';


// Si le formulaire est soumis...
if (!empty($_POST)) {

    // 1. Récupération des champs du formulaire dans des variables
    $title_category = trim($_POST['title_category']);
    $image = $_FILES['image'];


    // 2. Validation des données du formulaire
    if (!$title_category) {
        $errors['title_category'] = 'Le champ "titre de la catégorie" est obligatoire';
    }
    if (!array_key_exists('image', $_FILES) || $_FILES['image']['error'] == UPLOAD_ERR_NO_FILE) {
        $errors['image'] = 'Le champ "image de la catégorie" est obligatoire';
    } else {
        $mimetype = getFileMimeType($_FILES['image']['tmp_name']);
        // dd($mimetype);
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml', 'image/webp'];
        if (!in_array($mimetype, $allowedMimeTypes)) {
            $errors['image'] = 'Veuillez charger un fichier image valide (JPG, PNG, GIF, SVG, WEBP)';
        } else {
            if (filesize($_FILES['image']['tmp_name']) > MAX_UPLOADED_FILE_SIZE) {
                $errors['image'] = 'Le fichier ne doit pas excéder 1Mo';
            }
        }
    }

    if ($categoryModel->getCategoryByTitle($title_category)) {
        $errors['title_category'] = 'Il existe déjà une catégorie associée à ce titre';
    }

    // Si aucune erreur... 
    if (empty($errors)) {
        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $basename = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
        $basename = slugify($basename);

        // ajout chaîne de caratères unique
        $filename = $basename . sha1(uniqid(rand(), true)) . '.' . $extension;

        // vérifie si le dossier d'enregistrement de l'image existe
        if (!file_exists('img/category')) {
            mkdir('./img/category/', 0777, true);
        }
        // enregistre l'image dans le bon dossier avec le bon nom
        move_uploaded_file($_FILES['image']['tmp_name'], 'img/category/' . $filename);

        // Insertion de la catégorie en base de données
        $categoryModel->insertCategory($title_category, $filename);

        // Message flash
        addFlash('La catégorie a bien été créée');

        // Redirection
        header('Location: ' . buildUrl('admin_add_category'));
        exit;
    }
}

// Affichage : inclusion du template
$template = 'admin/add_category';
include '../templates/admin/base.phtml';

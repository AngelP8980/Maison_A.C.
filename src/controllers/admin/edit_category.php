<?php

// Vérification de connexion de l'administrateur
if (!isAdmin()) {
    echo ('Page introuvable');
    exit;
}

// Import de classes
use App\Model\CategoryModel;

// Récupération et validation de l'id de la catégorie de l'URL (chaîne de requête)
if (!array_key_exists('id_category', $_GET) || !ctype_digit($_GET['id_category'])) {
    echo 'Id de la categorie incorrect';
    exit;
}

// Ici je sais que j'ai bien mon paramètre id dans l'URL et que c'est un nombre
$categoryId = $_GET['id_category'];

// Initialisations
$errors = []; // Tableau qui contiendra les erreurs

// Sélection de la catégorie à modifier dans la base de données à partir de son id
$categoryModel = new CategoryModel();
$category = $categoryModel->getOneCategoryById($categoryId);

// la catégorie existe-t-elle bien ?
if (!$category) {
    echo 'Catégorie introuvable';
    exit;
}

// Variables qui vont permettre de pré remplir le formulaire
// avec les valeurs de la catégorie à modifier
$id = $category['id_category'];
$title = $category['title_category'];
$filename = $category['image'];

// Si le formulaire est soumis...
if (!empty($_POST)) {

    // On récupère les données du formulaire
    $title = trim($_POST['title_category']);
    $image = $_FILES['image'];

    // Validation des données
    if (!$title) {
        $errors['title_category'] = 'Le champ "titre" est obligatoire';
    }
    if (array_key_exists('image', $_FILES) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
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

    // Si pas d'erreurs...
    if (empty($errors)) {
        if (array_key_exists('image', $_FILES) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
            // suppression de l'image actuelle
            if (file_exists('img/category/' . $filename)) {
                unlink('img/category/' . $filename);
            }
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
        }
        // Insertion de la catégorie en base de données
        $categoryModel->editCategory($categoryId, $title, $filename);

        // Ajouter un message flash
        addFlash('La catégorie a bien été modifiée.');

        // Redirection 
        header('Location: ' . buildUrl('admin_list_category'));
        exit;
    }
}

// Affichage du nombre d'instances de PDO
// dump(AbstractModel::getCountPDO());

// Affichage du formulaire : inclusion du fichier de template
$template = 'admin/edit_category';
include '../templates/admin/base.phtml';

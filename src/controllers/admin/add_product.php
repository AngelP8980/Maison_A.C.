<?php

// Vérification de connexion de l'administrateur
if (!isAdmin()) {
    echo ('Page introuvable');
    exit;
}

// Import de classes
use App\Model\ProductModel;
use App\Model\CategoryModel;
use App\Model\TechnicModel;

$productModel = new ProductModel();
$categoryModel = new CategoryModel();
$technicModel = new TechnicModel();

// Flash messages
$flashMessage = fetchFlash("Le produit a bien été créé");

// Initialisations
const PASSWORD_MIN_LENGTH = 8; // Longueur minimale du mot de passe

$errors = []; // Tableau qui contiendra les erreurs

$title_product = '';
$image = '';
$accessories = '';
$categories = $categoryModel->getCategoryAll();
$technics = $technicModel->getTechnicAll();
$price = '';
$description = '';
$the_most = '';
$features = '';
$dimensions = '';
$precision_description = '';

// Si le formulaire est soumis...
if (!empty($_POST)) {

    // 1. Récupération des champs du formulaire dans des variables
    $title_product = trim($_POST['title_product']);
    $image = $_FILES['image'];
    $accessories = trim($_POST['accessories']);
    $price = floatval(str_replace(',', '.', str_replace('.', '', $_POST['price'])));
    $description = $_POST['description'];
    $the_most = $_POST['the_most'];
    $features = $_POST['features'];
    $dimensions = $_POST['dimensions'];
    $precision_description = $_POST['precision_description'];
    $category = $_POST['category'];
    $technic = $_POST['technic'];

    // 2. Validation des données du formulaire
    if (!$title_product) {
        $errors['title_product'] = 'Le champ "titre du produit" est obligatoire';
    }
    if (!array_key_exists('image', $_FILES) || $_FILES['image']['error'] == UPLOAD_ERR_NO_FILE) {
        $errors['image'] = 'Le champ "image du produit" est obligatoire';
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
    if (!$accessories) {
        $errors['accessories'] = 'Le champ "accessoires liés au produit" est obligatoire';
    }
    if (!$price) {
        $errors['price'] = 'Le champ "prix du produit" est obligatoire';
    }
    if (!$description) {
        $errors['description'] = 'Le champ "description du produit" est obligatoire';
    }
    if (!$the_most) {
        $errors['the_most'] = 'Le champ "les + du produit" est obligatoire';
    }
    if (!$features) {
        $errors['features'] = 'Le champ "composition du produit" est obligatoire';
    }
    if (!$dimensions) {
        $errors['dimensions'] = 'Le champ "dimension du produit" est obligatoire';
    }
    if (!$precision_description) {
        $errors['precision_description'] = 'Le champ "précisions sur le produit" est obligatoire';
    }
    if (!$category) {
        $errors['category'] = 'Veuillez sélectionner une catégorie';
    }
    if (!$technic) {
        $errors['technic'] = 'Veuillez sélectionner une technique';
    }

    if ($productModel->getProductByTitle($title_product)) {
        $errors['title_product'] = 'Il existe déjà un produit associé à ce titre';
    }

    // Si aucune erreur... 
    if (empty($errors)) {
        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $basename = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
        $basename = slugify($basename);

        // ajout chaîne de caratères unique
        $filename = $basename . sha1(uniqid(rand(), true)) . '.' . $extension;

        // vérifie si le dossier d'enregistrement de l'image existe
        if (!file_exists('img/product')) {
            mkdir('./img/product/', 0777, true);
        }
        // enregistre l'image dans le bon dossier avec le bon nom
        move_uploaded_file($_FILES['image']['tmp_name'], 'img/product/' . $filename);

        // Insertion du produit en base de données
        $productModel->insertProduct($title_product, $filename, $accessories, $price, $description, $the_most, $features, $dimensions, $precision_description, $category, $technic);

        // Message flash
        addFlash("Le produit a bien été créé") .

            // Redirection
            header('Location: ' . buildUrl('admin_add_product'));
        exit;
    }
}

// Affichage : inclusion du template
$template = 'admin/add_product';
include '../templates/admin/base.phtml';

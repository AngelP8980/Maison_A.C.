<?php 

// Import de classes
use App\Model\ProductModel;

// Initialisations
const PASSWORD_MIN_LENGTH = 8; // Longueur minimale du mot de passe

$errors = []; // Tableau qui contiendra les erreurs

$title_product = '';
$accessories = '';
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
    $accessories = trim($_POST['accessories']); 
    $price = floatval(str_replace(',', '.', str_replace('.', '', $_POST['price'])));
    $description = $_POST['description'];
    $the_most = $_POST['the_most'];
    $features = $_POST['features'];
    $dimensions = $_POST['dimensions'];
    $precision_description = $_POST['precision_description'];

    // 2. Validation des données du formulaire
    if (!$title_product) {
        $errors['title_product'] = 'Le champ "titre du produit" est obligatoire';
    }
    if (!$accessories) {
        $errors['accessories'] = 'Le champ "Accessoires liés au produit" est obligatoire';
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
    
    
    $productModel = new ProductModel();
    if ($productModel->getProductByTitle($title_product)) {
        $errors['title_product'] = 'Il existe déjà un produit associé à ce titre';
    }

    // Si aucune erreur... 
    if (empty($errors)) {

        // Insertion du produit en base de données
        $productModel->insertProduct($title_product, $accessories, $price, $description, $the_most, $features, $dimensions, $precision_description);

        // Message flash
        addFlash("Le produit a bien été créé").

        // Redirection
        header('Location: /');
        exit;
    }
}

// Affichage : inclusion du template
$template = 'admin/add_product';
include '../templates/admin/base.phtml';

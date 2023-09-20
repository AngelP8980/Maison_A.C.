<?php 

// Import de classes
use App\Model\ProductModel;

// Initialisations
const PASSWORD_MIN_LENGTH = 8; // Longueur minimale du mot de passe

$errors = []; // Tableau qui contiendra les erreurs

$title_product = '';
$description = '';
$price = '';

// Si le formulaire est soumis...
if (!empty($_POST)) {

    // 1. Récupération des champs du formulaire dans des variables
    $title_product = trim($_POST['title_product']); 
    $description = $_POST['description'];
    $price = floatval(str_replace(',', '.', str_replace('.', '', $_POST['price'])));
   

    // 2. Validation des données du formulaire
    if (!$title_product) {
        $errors['title_product'] = 'Le champ "titre" est obligatoire';
    }
    if (!$description) {
        $errors['description'] = 'Le champ "description" est obligatoire';
    }
    if (!$price) {
        $errors['price'] = 'Le champ "prix" est obligatoire';
    }
    
    $ProductModel = new ProductModel();
    if ($productModel->getProductByTitle($title_product)) {
        $errors['title_product'] = 'Il existe déjà un article associée à ce titre';
    }

    // Si aucune erreur... 
    if (empty($errors)) {

        // Insertion de la catégorie en base de données
        $productModel->insertProduct($title_product, $description, $price);

        // Message flash
        addFlash("L'article a bien été créée").

        // Redirection
        header('Location: /');
        exit;
    }
}

// Affichage : inclusion du template
$template = 'admin/add_product';
include '../templates/admin/base.phtml';

<?php 

// Import de classes
use App\Model\ProductModel;

// Récupération et validation de l'id du produit de l'URL (chaîne de requête)
if (!array_key_exists('id_product', $_GET) || !ctype_digit($_GET['id_product'])) {
    echo 'Id du produit incorrect';
    exit;
}

// Ici je sais que j'ai bien mon paramètre id dans l'URL et que c'est un nombre
$productId = $_GET['id_product'];

// Initialisations
$errors = []; // Tableau qui contiendra les erreurs

// Sélection du produit à modifier dans la base de données à partir de son id
$productModel = new ProductModel();
$product = $productModel->getOneProductById($productId);

// le produit existe-t-il bien ?
if (!$product) {
    echo 'Produit introuvable';
    exit;
}

// Variables qui vont permettre de pré remplir le formulaire
// avec les valeurs du produit à modifier
$id = $product['id_product'];
$title = $product['title_product'];
$accessories = $product['accessories'];
$id_category = $product['id_category'];
$id_technic = $product['id_technic'];
$price = $product['price'];
$description = $product['description'];
$the_most = $product['the_most'];
$features = $product['features'];
$dimensions = $product['dimensions'];
$precision_description = $product['precision_description'];

// Si le formulaire est soumis...
if (!empty($_POST)) {

    // On récupère les données du formulaire
    $id = trim($_POST['id_product']);
    $title = trim($_POST['title_product']);
    $accessories = trim($_POST['accessories']);
    $id_category = trim($_POST['id_category']);
    $id_technic = trim($_POST['id_technic']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);
    $the_most = trim($_POST['the_most']);
    $features = trim($_POST['features']);
    $dimensions = trim($_POST['dimensions']);
    $precision_description = trim($_POST['precision_description']);

   
    // Validation des données
    if (!$title) {
        $errors['title_product'] = 'Le champ "titre" est obligatoire';
    }
    if (!$accessories) {
        $errors['accessories'] = 'Le champ "accessoires" est obligatoire';
    }
    if (!$price) {
        $errors['price'] = 'Le champ "prix" est obligatoire';
    }
    if (!$description) {
        $errors['description'] = 'Le champ "description" est obligatoire';
    }
    if (!$the_most) {
        $errors['the_most'] = 'Le champ "les +" est obligatoire';
    }
    if (!$features) {
        $errors['features'] = 'Le champ "caractéristiques" est obligatoire';
    }
    if (!$dimensions) {
        $errors['dimensions'] = 'Le champ "dimensions" est obligatoire';
    }
    if (!$precision_description) {
        $errors['precision_description'] = 'Le champ "précision" est obligatoire';
    }   

    // Si pas d'erreurs...
    if (empty($errors)) {

        // Insertion du produit en base de données
        $productModel->editProduct($id, $title, $accessories, $id_category, $id_technic, $price, $description, $the_most, $features, $dimensions, $precision_description);

        // Ajouter un message flash
        addFlash('La produit a bien été modifiée.');

        // Redirection 
        header('Location: /');
        exit;
    }
}

// Affichage du nombre d'instances de PDO
// dump(AbstractModel::getCountPDO());

// Affichage du formulaire : inclusion du fichier de template
$template = 'admin/edit_product';
include '../templates/base.phtml'; 
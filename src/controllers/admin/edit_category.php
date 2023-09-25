<?php 

// Import de classes
use App\Model\CategoryModel;

// Récupération et validation de l'id de la catégorie de l'URL (chaîne de requête)
if (!array_key_exists('id_category', $_GET) || !ctype_digit($_GET['id_category'])) {
    echo 'Id de la categorie incorrect';
    exit;
}

// Ici je sais que j'ai bien mon paramètre id dans l'URL et que c'est un nombre
$categoryId = $_GET['id_catégory'];

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

// Si le formulaire est soumis...
if (!empty($_POST)) {

    // On récupère les données du formulaire
    $id = trim($_POST['id_category']);
    $title = trim($_POST['title_category']);
   
    // Validation des données
    if (!$title) {
        $errors['title_category'] = 'Le champ "titre" est obligatoire';
    }

    // Si pas d'erreurs...
    if (empty($errors)) {

        // Insertion de la catégorie en base de données
        $categoryModel->editCategory($id, $title);

        // Ajouter un message flash
        addFlash('La catégorie a bien été modifiée.');

        // Redirection 
        header('Location: /');
        exit;
    }
}

// Affichage du nombre d'instances de PDO
// dump(AbstractModel::getCountPDO());

// Affichage du formulaire : inclusion du fichier de template
$template = 'admin/edit_category';
include '../templates/base.phtml'; 
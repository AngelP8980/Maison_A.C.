<?php 

// Import de classes
use App\Model\ArticleModel;

// Initialisations
const PASSWORD_MIN_LENGTH = 8; // Longueur minimale du mot de passe

$errors = []; // Tableau qui contiendra les erreurs

$title_article = '';
$description = '';
$price = '';

// Si le formulaire est soumis...
if (!empty($_POST)) {

    // 1. Récupération des champs du formulaire dans des variables
    $title_article = trim($_POST['title_article']); 
    $description = $_POST['description'];
    $price = floatval(str_replace(',', '.', str_replace('.', '', $_POST['price'])));
   

    // 2. Validation des données du formulaire
    if (!$title_article) {
        $errors['title_article'] = 'Le champ "titre" est obligatoire';
    }
    if (!$description) {
        $errors['description'] = 'Le champ "description" est obligatoire';
    }
    if (!$price) {
        $errors['price'] = 'Le champ "prix" est obligatoire';
    }
    
    $ArticleModel = new ArticleModel();
    if ($articleModel->getArticleByTitle($title_article)) {
        $errors['title_article'] = 'Il existe déjà un article associée à ce titre';
    }

    // Si aucune erreur... 
    if (empty($errors)) {

        // Insertion de la catégorie en base de données
        $articleModel->insertArticle($title_article, $description, $price);

        // Message flash
        addFlash("L'article a bien été créée").

        // Redirection
        header('Location: /');
        exit;
    }
}

// Affichage : inclusion du template
$template = 'admin/add_article';
include '../templates/admin/base.phtml';

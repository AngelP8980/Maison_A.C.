<?php 

// Import de classes
use App\Model\ArticleModel;

// Initialisations
const PASSWORD_MIN_LENGTH = 8; // Longueur minimale du mot de passe

$errors = []; // Tableau qui contiendra les erreurs

$title_category = '';


// Si le formulaire est soumis...
if (!empty($_POST)) {

    // 1. Récupération des champs du formulaire dans des variables
    $title_article = trim($_POST['title_article']); 
   

    // 2. Validation des données du formulaire
    if (!$title_article) {
        $errors['title_article'] = 'Le champ "titre" est obligatoire';
    }

    
    $ArticleModel = new ArticleModel();
    if ($articleModel->getArticleByTitle($title_article)) {
        $errors['title_article'] = 'Il existe déjà un article associée à ce titre';
    }

    // Si aucune erreur... 
    if (empty($errors)) {

        // Insertion de la catégorie en base de données
        $articleModel->insertArticle($title_article);

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

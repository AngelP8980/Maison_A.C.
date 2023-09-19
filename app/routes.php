<?php 

/**
 * On définit dans le tableau associatif $routes lal iste de nos routes.
 * Pour chaque route, on définit : 
 * - son nom 
 * - path (qui apparaît dans l'URL)
 * - controller : fichier à appeler 
 */

$routes = [

    // Page d'accueil
    'home' => [
        'path' => '/',
        'controller' => 'home.php'
    ],

    // Création de compte
    'signup' => [
        'path' => '/signup',
        'controller' => 'signup.php'
    ],

    // Connexion utilisateur
    'login' => [
        'path' => '/login',
        'controller' => 'login.php'
    ],

    // Déconnexion
    'logout' => [
        'path' => '/logout',
        'controller' => 'logout.php'
    ],
    
    // Dashboard admin
    'admin' => [
        'path' => '/admin',
        'controller' => 'admin/admin.php'
    ],

    // Création de catégories
    'admin_add_category' => [
        'path' => '/admin/category/add',
        'controller' => 'admin/add_category.php'
    ],

    // Création d'articles
    'admin_add_article' => [
        'path' => '/admin/article/add',
        'controller' => 'admin/add_article.php'
    ],

    // Catalogue
    'catalog' => [
        'path' => '/catalog',
        'controller' => 'catalog.php'
    ],

    // Catégories
    'category' => [
        'path' => '/category',
        'controller' => 'category.php'
    ],    

    // Produits
    'product' => [
        'path' => '/product',
        'controller' => 'produit.php'
    ], 

    // Contact
    'produit' => [
        'path' => '/contact',
        'controller' => 'contact.php'
    ],

];

return $routes;
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

    // Création de produits
    'admin_add_product' => [
        'path' => '/admin/product/add',
        'controller' => 'admin/add_product.php'
    ],

    // Création de techniques
    'admin_add_technic' => [
        'path' => '/admin/technic/add',
        'controller' => 'admin/add_technic.php'
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
        'controller' => 'product.php'
    ], 

    // Contact
    'contact' => [
        'path' => '/contact',
        'controller' => 'contact.php'
    ],

];

return $routes;
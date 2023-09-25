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

    // Modification d'une catégorie
    'admin_edit_category' => [
        'path' => '/admin/category/edit',
        'controller' => 'admin/edit_category.php'
    ],

     // Création de techniques
     'admin_add_technic' => [
        'path' => '/admin/technic/add',
        'controller' => 'admin/add_technic.php'
    ], 

    // Modification d'une technique
    'admin_edit_technic' => [
        'path' => '/admin/technic/edit',
        'controller' => 'admin/edit_tehnic.php'
    ],

    // Création de produits
    'admin_add_product' => [
        'path' => '/admin/product/add',
        'controller' => 'admin/add_product.php'
    ],

    // Modification d'un produit
    'admin_edit_product' => [
        'path' => '/admin/product/edit',
        'controller' => 'admin/edit_product.php'
    ],

    // Liste des catégories
    'admin_list_category' => [
        'path' => '/admin/category/list',
        'controller' => 'admin/list_category.php'
    ],

    // Liste des techniques
    'admin_list_technic' => [
        'path' => '/admin/technic/list',
        'controller' => 'admin/list_technic.php'
    ],

    // Liste des produits
    'admin_list_product' => [
        'path' => '/admin/product/list',
        'controller' => 'admin/list_product.php'
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

<?php

/**
 * Démarre la session si la session n'est pas déjà démarrée
 */
function initSession()
{
    // Si aucune session n'est démarrée pour le moment...
    if (session_status() == PHP_SESSION_NONE) {

        // ... on démarre la session
        session_start();
    }
}


/**
 * Ajoute un message en session
 * @param string $message Le message à ajouter en session
 */
function addFlash(string $message)
{
    initSession();

    $_SESSION['flashbag'] = $message;
}

/**
 * Détermine si il y a un message flash en session ou non
 * @return bool true s'il y a un message, false sinon
 */
function hasFlash(): bool
{
    initSession();

    return isset($_SESSION['flashbag']);
}

/**
 * Récupère le message flash de la session
 * @return null|string Le message flash ou null
 */
function fetchFlash(): ?string
{
    initSession();

    // Initialisation de la variable $flashMessage
    $flashMessage = null;

    // Récupération du message flash s'il existe
    if (hasFlash()) {

        // On récupère le message flash dans une variable
        $flashMessage = $_SESSION['flashbag'];

        // On efface le message de la session
        $_SESSION['flashbag'] = null;
    }

    return $flashMessage;
}



/**
 * Vérifie les identifiants de connexion et retourne les données 
 * de l'utilisateur si les identifiants sont corrects, 
 * un tableau vide sinon
 */
function checkCredentials($email, $password): array
{
    // 1°) Récupérer un utilisateur à partir de l'email
    $userModel = new App\Model\UserModel();
    $user = $userModel->getUserByEmail($email);

    // Si résultat vide => tableau vide
    if (!$user) {
        return [];
    }

    // 2°) Si l'email existe bien, on vérifie le mot de passe
    if (!password_verify($password, $user['password'])) {
        return [];
    }

    // Si on arrive ici, tout est OK
    return $user;
}

/**
 * Enregistre en session les données de l'utilisateur
 */
function registerUser(int $userId, string $email, string $firstname, string $lastname, string $phone, bool $isAdmin)
{
    // On s'assure que la session est bien démarrée
    initSession();

    $_SESSION['user'] = [
        'id' => $userId,
        'email' => $email,
        'firstname' => $firstname,
        'lastname' => $lastname,
        'phone' => $phone,
        'isAdmin' => $isAdmin
    ];
}

/**
 * Vérifie si l'utilisateur est connecté ou non
 */
function isConnected(): bool
{
    initSession();

    return array_key_exists('user', $_SESSION) && isset($_SESSION['user']);
}

/**
 * Vérifie si l'administrateur est connecté ou non
 */
function isAdmin(): bool
{
    initSession();

    return isConnected() && $_SESSION['user']['isAdmin'];
}

/**
 * Construction d'URLs absolues
 */
function buildUrl(string $routeName, array $params = []): string
{
    $routes = require "../app/routes.php";
    if (isset($routes[$routeName])) {
        $path = $routes[$routeName]['path'];

        if (!empty($params)) {
            $path .= '?' . http_build_query($params);
        }

        // Concaténation de BASE_URL avec le chemin de la ressource en paramètre
        $url = rtrim(BASE_URL, '/') . '/' . ltrim($path, '/');

        return $url;
    } else {
        throw new Exception("Route introuvable : $routeName", 404);
    }
}

function asset(string $resourcePath): string
{
    // Utilisation de la constante BASE_URL pour construire l'URL complet
    $url = rtrim(BASE_URL, '/') . '/' . ltrim($resourcePath, '/');

    // Retourne l'URL construite
    return $url;
}

/**
 * SLUG : supprime les caractères spéciaux
 */
function slugify($text)
{
    // Strip html tags
    $text = strip_tags($text);
    // Replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    // Transliterate
    setlocale(LC_ALL, 'fr_FR.utf8');
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    // Remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);
    // Trim
    $text = trim($text, '-');
    // Remove duplicate -
    $text = preg_replace('~-+~', '-', $text);
    // Lowercase
    $text = strtolower($text);
    // Check if it is empty
    if (empty($text)) {
        return 'n-a';
    }
    // Return result
    return $text;
}

/**
 * Récupère le type MIME d'un fichier
 */
function getFileMimeType(string $filePath): string
{
    // Create a Fileinfo resource
    $finfo = finfo_open(FILEINFO_MIME_TYPE);

    if ($finfo) {
        // Get the MIME type of the file
        $mime_type = finfo_file($finfo, $filePath);

        // Close the Fileinfo resource
        finfo_close($finfo);

        return $mime_type;
    } else {
        throw new Exception("Failed to open Fileinfo");
    }
}





/**
 * Construction du chemin vers les ressources (CSS, JS, images, etc.)
 */
// function asset(string $asset) {
//     return BASE_URL . '/' . $asset;
// }

/**
 * Validation de l'envoi du formulaire de contact
 */
// function validate() {
//     var isValid = true;

//     var lastname = $("#lastname").val();
//     var firstname = $("#firstname").val();
//     var email = $("#email").val();
//     var phone = $("#phone").val();
//     var message = $("#message").val();

//     if (lastname == "") {
//         $("#lastname");
//         isValid = false;
//     }
//     if (firstname == "") {
//         $("#firstname");
//         isValid = false;
//     }
//     if (email == "") {
//         $("#email");
//         isValid = false;
//     }
//     if (!email.match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
//         $("#info");
//         $("#email");
//         isValid = false;
//     }
//     if (phone == "") {
//         $("#phone");
//         isValid = false;
//     }
//     if (message == "") {
//         $("#message");
//         isValid = false;
//     }
//     return isValid;
// }
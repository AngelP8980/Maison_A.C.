<?php

// Dans quel espace de nom (namespace) je travaille ?
// Chemin des dossiers : src/Core
namespace App\Core;

// Import des classes
use PDO;

/**
 * Je définie ma classe Model comme "abstraite" 
 * Je ne vais pas l'utiliser directement, on va pas créer d'objet Model
 * On ne fera jamais de $model = new Model();
 *  -> elle ne va servir qu'indirectement via d'autres classes qui vont en hériter
 */
abstract class AbstractModel
{

    static protected ?PDO $pdo = null;

    function __construct()
    {
        if (self::$pdo == null) {

            // Appel de la méthode statique getPDOCOnnection directement sur la classe Database pour créer l'objet PDO
            self::$pdo = Database::getPDOConnection();
        }
    }
}

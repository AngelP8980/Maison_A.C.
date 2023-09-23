<?php 

// Définition du namespace
namespace App\Model;

// Import des classes
use App\Core\AbstractModel;

class TechnicModel extends AbstractModel {

    function getTechnicByTitle(string $title_technic): array 
    {
        // Préparation de la requête
        $sql = 'SELECT * FROM technic WHERE title_technic = ?';
        $pdoStatement = self::$pdo->prepare($sql);

        // Exécution de la requête
        $pdoStatement->execute([$title_technic]);

        // Récupération du résultat 
        $technic = $pdoStatement->fetch();

        if (!$technic) {
            return [];
        }
        return $technic;
    }

    /** 
     * Insère la technique en base de données
     */
    function insertTechnic(string $title_technic)
    {
    
        // Insertion des données 
        $sql = 'INSERT INTO technic (title_technic, createdAt)
                VALUES (?, NOW())';

        $pdoStatement = self::$pdo->prepare($sql);
        $pdoStatement->execute([$title_technic]);
    }
}
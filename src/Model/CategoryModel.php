<?php 

// Définition du namespace
namespace App\Model;

// Import des classes
use App\Core\AbstractModel;

class CategoryModel extends AbstractModel {

    function getCategoryByTitle(string $title): array 
    {
        // Préparation de la requête
        $sql = 'SELECT * FROM user WHERE title = ?';
        $pdoStatement = self::$pdo->prepare($sql);

        // Exécution de la requête
        $pdoStatement->execute([$title]);

        // Récupération du résultat 
        $category = $pdoStatement->fetch();

        if (!$category) {
            return [];
        }
        return $category;
    }

    /** 
     * Insère la catégorie en base de données
     */
    function insertCategory(string $title)
    {
    
        // Insertion des données 
        $sql = 'INSERT INTO user (title, createdAt)
                VALUES (?, NOW())';

        $pdoStatement = self::$pdo->prepare($sql);
        $pdoStatement->execute([$title]);
    }
}
<?php 

// Définition du namespace
namespace App\Model;

// Import des classes
use App\Core\AbstractModel;

class CategoryModel extends AbstractModel {

    function getCategoryByTitle(string $title_category): array 
    {
        // Préparation de la requête
        $sql = 'SELECT * FROM category WHERE title_category = ?';
        $pdoStatement = self::$pdo->prepare($sql);

        // Exécution de la requête
        $pdoStatement->execute([$title_category]);

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
    function insertCategory(string $title_category)
    {
    
        // Insertion des données 
        $sql = 'INSERT INTO category (title_category, createdAt)
                VALUES (?, NOW())';

        $pdoStatement = self::$pdo->prepare($sql);
        $pdoStatement->execute([$title_category]);
    }
}
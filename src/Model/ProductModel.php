<?php 

// Définition du namespace
namespace App\Model;

// Import des classes
use App\Core\AbstractModel;

class ProductModel extends AbstractModel {

    function getProductByTitle(string $title_product): array 
    {
        // Préparation de la requête
        $sql = 'SELECT * FROM product WHERE title_product = ?';
        $pdoStatement = self::$pdo->prepare($sql);

        // Exécution de la requête
        $pdoStatement->execute([$title_product]);

        // Récupération du résultat 
        $article = $pdoStatement->fetch();

        if (!$article) {
            return [];
        }
        return $article;
    }

    /** 
     * Insère du produit en base de données
     */
    function insertProduct(string $title_product, string $description, float $price)
    {
    
        // Insertion des données 
        $sql = 'INSERT INTO product (title_product, description, price, createdAt)
                VALUES (?, ?, ?, NOW())';

        $pdoStatement = self::$pdo->prepare($sql);
        $pdoStatement->execute([$title_product, $description, $price]);
    }
}
<?php 

// Définition du namespace
namespace App\Model;

// Import des classes
use App\Core\AbstractModel;
use PDOException;
use PDOStatement;

class ProductModel extends AbstractModel {

    function getProductByTitle(string $title_product): array 
    {
        // Préparation de la requête
        $sql = 'SELECT * FROM product WHERE title_product = ?';
        $pdoStatement = self::$pdo->prepare($sql);

        // Exécution de la requête
        $pdoStatement->execute([$title_product]);

        // Récupération du résultat 
        $product = $pdoStatement->fetch();

        if (!$product) {
            return [];
        }
        return $product;
    }

    /** 
     * Insère le produit en base de données
     */
    function insertProduct(
        string $title_product, string $accessories, float $price, string $description, string $the_most, string $features, string $dimensions, string $precision_description, int $id_category, int $id_technic)
    {
    
        // Insertion des données 
        $sql = 'INSERT INTO product (title_product, accessories, price, description, the_most, features, dimensions, precision_description, id_category, id_technic, createdAt)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())';

        $pdoStatement = self::$pdo->prepare($sql);
        $pdoStatement->execute([$title_product, $accessories, $price, $description, $the_most, $features, $dimensions, $precision_description, $id_category, $id_technic]);

    }

    /** 
     * Cherche tous les produits en base de données
     */
    function getProductAll(): array 
    {
        // Préparation de la requête
        $sql = 'SELECT * FROM product';
        $pdoStatement = self::$pdo->prepare($sql);

        // Exécution de la requête
        $pdoStatement->execute([]);
        
        // Récupération du résultat 
        $products = $pdoStatement->fetchAll();
        if (!$products) {
            return [];
        }
        return $products;
    }
}
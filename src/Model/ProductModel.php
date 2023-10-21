<?php

// Définition du namespace
namespace App\Model;

// Import des classes
use App\Core\AbstractModel;
use PDOException;
use PDOStatement;

class ProductModel extends AbstractModel
{

    function getProductByTitle(string $title_product): array
    {
        // Préparation de la requête
        $sql = 'SELECT * FROM product 
                WHERE title_product = ?';
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
        string $title_product,
        string $image,
        string $accessories,
        float $price,
        string $description,
        string $the_most,
        string $features,
        string $dimensions,
        string $precision_description,
        int $id_category,
        int $id_technic
    ) {

        // Insertion des données 
        $sql = 'INSERT INTO product (title_product, image, accessories, id_category, id_technic, price, description, the_most, features, dimensions, precision_description, createdAt)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())';

        $pdoStatement = self::$pdo->prepare($sql);
        $pdoStatement->execute([$title_product, $image, $accessories, $id_category, $id_technic, $price, $description, $the_most, $features, $dimensions, $precision_description]);
    }

    /** 
     * Cherche tous les produits en base de données
     */
    function getProductAll(): array
    {
        // Préparation de la requête
        $sql = 'SELECT *, P.image AS product_image FROM product AS P
                INNER JOIN category AS C ON C.id_category = P.id_category
                INNER JOIN technic AS T ON T.id_technic = P.id_technic';
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

    /**
     * Sélectionne un produit à partir de son id
     * @param int $productId L'id du produit que je souhaite sélectionner
     * @return array Le produit sélectionné
     */
    function getOneProductById(int $productId): array
    {

        // Préparation de la requête de sélection
        $sql = 'SELECT id_product, title_product, image, accessories, id_category, id_technic, price, description, the_most, features, dimensions, precision_description
                FROM product AS P
                WHERE id_product = ?';

        $pdoStatement = self::$pdo->prepare($sql);

        // Exécution de la requête
        $pdoStatement->execute([$productId]);

        // Récupération et retour du résultat de la requête SQL
        $product = $pdoStatement->fetch();

        if (!$product) {
            return [];
        }

        return $product;
    }

    /**
     * Sélection des produits par l'id de leur catégorie
     */
    function getProductsByCategoryId(int $categoryId): array
    {

        // Préparation de la requête
        $sql = 'SELECT *, P.image AS product_image 
                FROM product AS P
                WHERE P.id_category = ?';

        $pdoStatement = self::$pdo->prepare($sql);

        // Exécution de la requête
        $pdoStatement->execute([$categoryId]);

        // Récupération du résultat 
        $products = $pdoStatement->fetchAll();
        if (!$products) {
            return [];
        }
        return $products;
    }

    /** 
     * Modifie un produit en base de données
     */
    function editProduct(int $productId, string $title_product, string $image, string $accessories, string $category, string $technic, float $price, string $description, string $the_most, string $features, string $dimensions, string $precision_description)
    {
        // Insertion des données dans la base de données
        $sql = 'UPDATE product 
                SET title_product = ?, image = ?, accessories = ?, id_category = ?, id_technic = ?, price = ?, description = ?, the_most = ?, features = ?, dimensions = ?, precision_description = ?
                WHERE id_product = ?';

        $pdoStatement = self::$pdo->prepare($sql);
        $pdoStatement->execute([$title_product, $image, $accessories, $category, $technic, $price, $description, $the_most, $features, $dimensions, $precision_description, $productId]);
    }

    /**
     * Supprime un produit à partir de son id
     * @param int $productId L'id du produit à supprimer
     */
    function deleteProduct(int $productId)
    {

        // Préparation de la requête SQL de suppression
        $sql = 'DELETE FROM product WHERE id_product = ?';

        $pdoStatement = self::$pdo->prepare($sql);

        // Exécution de la requête
        $pdoStatement->execute([$productId]);
    }
}

<?php

// Définition du namespace
namespace App\Model;

// Import des classes
use App\Core\AbstractModel;

class CategoryModel extends AbstractModel
{

    function getCategoryByTitle(string $title_category): array
    {
        // Préparation de la requête
        $sql = 'SELECT * FROM category WHERE title_category = ?';
        $pdoStatement = self::$pdo->prepare($sql);

        // Exécution de la requête
        $pdoStatement->execute([$title_category]);

        // Récupération du résultat 
        $category = $pdoStatement->fetch();

        // Si aucune catégorie n'est trouvée, renvoyer un tableau vide
        if (!$category) {
            return [];
        }
        return $category;
    }

    /** 
     * Insère la catégorie en base de données
     */
    function insertCategory(
        string $title_category,
        string $image
    ) {

        // Insertion des données 
        $sql = 'INSERT INTO category (title_category, image, createdAt)
                VALUES (?, ?, NOW())';

        $pdoStatement = self::$pdo->prepare($sql);
        $pdoStatement->execute([$title_category, $image]);
    }

    /** 
     * Cherche toutes les catégories en base de données
     */
    function getCategoryAll(): array
    {
        // Préparation de la requête
        $sql = 'SELECT * FROM category';
        $pdoStatement = self::$pdo->prepare($sql);

        // Exécution de la requête
        $pdoStatement->execute([]);

        // Récupération du résultat 
        $categories = $pdoStatement->fetchAll();
        if (!$categories) {
            return [];
        }
        return $categories;
    }

    /**
     * Sélectionne une catégorie à partir de son id
     * @param int $categoryId L'id de la categorie que je souhaite sélectionner
     * @return array La catégorie sélectionnée
     */
    function getOneCategoryById(int $categoryId): array
    {

        // Préparation de la requête de sélection
        $sql = 'SELECT title_category, id_category, image 
                FROM category AS C
                WHERE id_category = ?';

        $pdoStatement = self::$pdo->prepare($sql);

        // Exécution de la requête
        $pdoStatement->execute([$categoryId]);

        // Récupération et retour du résultat de la requête SQL
        $category = $pdoStatement->fetch();

        if (!$category) {
            return [];
        }

        return $category;
    }

    /** 
     * Modifie une catégorie en base de données
     */
    function editCategory(int $categoryId, string $title_category, string $image)
    {
        // Insertion des données dans la base de données
        $sql = 'UPDATE category 
                SET title_category = ?, image = ?
                WHERE id_category = ?';

        $pdoStatement = self::$pdo->prepare($sql);
        $pdoStatement->execute([$title_category, $image, $categoryId]);
    }

    /**
     * Supprime une catégorie à partir de son id
     * @param int $categoryId L'id de la catégorie à supprimer
     */
    function deleteCategory(int $categoryId)
    {

        // Préparation de la requête SQL de suppression
        $sql = 'DELETE FROM category WHERE id_category = ?';

        $pdoStatement = self::$pdo->prepare($sql);

        // Exécution de la requête
        $pdoStatement->execute([$categoryId]);
    }
}

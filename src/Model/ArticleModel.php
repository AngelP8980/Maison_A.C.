<?php 

// Définition du namespace
namespace App\Model;

// Import des classes
use App\Core\AbstractModel;

class ArticleModel extends AbstractModel {

    function getArticleByTitle(string $title_article): array 
    {
        // Préparation de la requête
        $sql = 'SELECT * FROM article WHERE title_article = ?';
        $pdoStatement = self::$pdo->prepare($sql);

        // Exécution de la requête
        $pdoStatement->execute([$title_article]);

        // Récupération du résultat 
        $article = $pdoStatement->fetch();

        if (!$article) {
            return [];
        }
        return $article;
    }

    /** 
     * Insère l'article en base de données
     */
    function insertArticle(string $title_article, string $description, float $price)
    {
    
        // Insertion des données 
        $sql = 'INSERT INTO article (title_article, description, price, createdAt)
                VALUES (?, ?, ?, NOW())';

        $pdoStatement = self::$pdo->prepare($sql);
        $pdoStatement->execute([$title_article, $description, $price]);
    }
}
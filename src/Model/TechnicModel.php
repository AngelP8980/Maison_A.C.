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

     /** 
     * Cherche toutes les techniques en base de données
     */
    function getTechnicAll(): array 
    {
        // Préparation de la requête
        $sql = 'SELECT * FROM technic';
        $pdoStatement = self::$pdo->prepare($sql);

        // Exécution de la requête
        $pdoStatement->execute([]);

        // Récupération du résultat 
        $technics = $pdoStatement->fetchAll();
        if (!$technics) {
            return [];
        }
        return $technics;
    }

     /**
     * Sélectionne une technique à partir de son id
     * @param int $technicId L'id de la technique que je souhaite sélectionner
     * @return array La technique sélectionnée
     */
    function getOneTechnicById(int $technicId): array
    {
       
        // Préparation de la requête de sélection
        $sql = 'SELECT title_technic, id_technic
                FROM technic AS T
                WHERE id_technic = ?';

        $pdoStatement = self::$pdo->prepare($sql);
        
        // Exécution de la requête
        $pdoStatement->execute([$technicId]);

        // Récupération et retour du résultat de la requête SQL
        $technic = $pdoStatement->fetch();

        if (!$technic) {
            return [];
        }

        return $technic;
    }

    /** 
     * Modifie une technique en base de données
     */
    function editTechnic(int $technicId, string $title_technic)
    {
        // Insertion des données dans la base de données
        $sql = 'UPDATE technic 
                SET title_technic = ?
                WHERE id_technic = ?';

        $pdoStatement = self::$pdo->prepare($sql);
        $pdoStatement->execute([$title_technic, $technicId]);
    }

     /**
     * Supprime une technique à partir de son id
     * @param int $technicId L'id de la technique à supprimer
     */
    function deleteTechnic(int $technicId)
    {
       
        // Préparation de la requête SQL de suppression
        $sql = 'DELETE FROM technic WHERE id_technic = ?';

        $pdoStatement = self::$pdo->prepare($sql);
        
        // Exécution de la requête
        $pdoStatement->execute([$technicId]);
    }
}
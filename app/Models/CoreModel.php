<?php
namespace Oquiz\Models;
use Oquiz\Database;
use PDO;
abstract class CoreModel {
  protected $id;
  /**
     * @var int
     */
    protected $status;
    /**
     * @var string
     */
    protected $date_inserted;
    /**
     * @var string
     */
    protected $date_updated;


    // Méthode permettant de gérer la sauvegarde en BDD
    // elle va détecter seul si elle insère ou met à jour
    public function save() {
      // Si on a un id => alors la ligne existe dans la table
      // => on met à jour
      if ($this->id > 0) {
        $retour = $this->update();
        return $retour;
      }
      // Sinon, la ligne n'existe pas dans la table
      // => on insère dans la table
      else {
        return $this->insert();
      }
    }



        public function delete() {
        $sql = '
            DELETE FROM '.static::TABLE_NAME.'
            WHERE id = :id
        ';
        // Je prépare
        $pdoStatement = Database::getPDO()->prepare($sql);

        // Je fais mes "binds"
        $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);

        // j'exécute la requête préparée
        $affectedRows = $pdoStatement->execute();

        return $affectedRows;
    }

    public static function find($id) {
      $sql = '
          SELECT *
          FROM '.static::TABLE_NAME.'
          WHERE id = :id';
      $pdoStatement = Database::getPDO()->prepare($sql);
      $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
      $pdoStatement->execute();
      $result = $pdoStatement->fetchObject(static::class);
      //dump($result);
      return $result;
    }

    public static function findAll() {
        $sql = "
            SELECT *
            FROM ".static::TABLE_NAME."
        ";
        $pdo = Database::getPDO();
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, static::class);
        return $results;
    }


    // Je suis une classe abstraite, je ne travaille pas, ce sont mes enfants qui bossent pour moi
    // Et en plus, je peux donner des ordres à mes enfants !

    // Ordre : mon enfant, définit une méthode "insert"
    protected abstract function insert();

    // Ordre : mon enfant, définit une méthode "update"



    public function getId() {
        return $this->id;
    }

        /**
     * Get the value of Status
     *
     * @return int
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * Set the value of Status
     *
     * @param int status
     */
    public function setStatus($status) {
        if (!empty($status)) {
            $this->status = $status;
        }
    }

    /**
     * Get the value of Date Inserted
     *
     * @return string
     */
    public function getDateInserted() {
        return $this->date_inserted;
    }

    /**
     * Get the value of Date Updated
     *
     * @return string
     */
    public function getDateUpdated() {
        return $this->date_updated;
    }
}

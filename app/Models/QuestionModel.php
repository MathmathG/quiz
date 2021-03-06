<?php
namespace Oquiz\Models;
use Oquiz\Database;
use PDO;
class QuestionModel extends CoreModel {

    protected $id;
    private $question;
    private $prop1;
    private $prop2;
    private $prop3;
    private $prop4;
    private $id_level;
    private $level;
    private $anecdote;
    private $wiki;


   /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Get the value of Question
     *
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }
    /**
     * Get the value of Prop
     *
     * @return mixed
     */
    public function getProp1()
    {
        return $this->prop1;
    }
    /**
     * Get the value of Prop
     *
     * @return mixed
     */
    public function getProp2()
    {
        return $this->prop2;
    }
    /**
     * Get the value of Prop
     *
     * @return mixed
     */
    public function getProp3()
    {
        return $this->prop3;
    }
    /**
     * Get the value of Prop
     *
     * @return mixed
     */
    public function getProp4()
    {
        return $this->prop4;
    }
    /**
     * Get the value of Id Level
     *
     * @return mixed
     */
    public function getIdLevel()
    {
        return $this->id_level;
    }
    /**
     * Get the value of Level
     *
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }
    /**
     * Get the value of Anecdote
     *
     * @return mixed
     */
    public function getAnecdote()
    {
        return $this->anecdote;
    }
    /**
     * Get the value of Wiki
     *
     * @return mixed
     */
    public function getWiki()
    {
        return $this->wiki;
    }
    /**
     * Set the value of Id
     *
     * @param mixed id
     *
     * @return self
     */
    private function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * Set the value of Question
     *
     * @param mixed question
     *
     * @return self
     */
    public function setQuestion($question)
    {
        $this->question = $question;
        return $this;
    }
    /**
     * Set the value of Prop
     *
     * @param mixed prop1
     *
     * @return self
     */
    public function setProp1($prop1)
    {
        $this->prop1 = $prop1;
        return $this;
    }
    /**
     * Set the value of Prop
     *
     * @param mixed prop2
     *
     * @return self
     */
    public function setProp2($prop2)
    {
        $this->prop2 = $prop2;
        return $this;
    }
    /**
     * Set the value of Prop
     *
     * @param mixed prop3
     *
     * @return self
     */
    public function setProp3($prop3)
    {
        $this->prop3 = $prop3;
        return $this;
    }
    /**
     * Set the value of Prop
     *
     * @param mixed prop4
     *
     * @return self
     */
    public function setProp4($prop4)
    {
        $this->prop4 = $prop4;
        return $this;
    }
    /**
     * Set the value of Id Level
     *
     * @param mixed id_level
     *
     * @return self
     */
    public function setIdLevel($id_level)
    {
        $this->id_level = $id_level;
        return $this;
    }
    /**
     * Set the value of Level
     *
     * @param mixed level
     *
     * @return self
     */
    public function setLevel($level)
    {
        $this->level = $level;
        return $this;
    }
    /**
     * Set the value of Anecdote
     *
     * @param mixed anecdote
     *
     * @return self
     */
    public function setAnecdote($anecdote)
    {
        $this->anecdote = $anecdote;
        return $this;
    }
    /**
     * Set the value of Wiki
     *
     * @param mixed wiki
     *
     * @return self
     */
    public function setWiki($wiki)
    {
        $this->wiki = $wiki;
        return $this;
    }
    const TABLE_NAME = 'questions';

protected function insert(){
    $sql= "
    INSERT INTO users
    (`first_name`, `last_name`, `email`, `password`)
    VALUES(:first_name, :last_name, :email, :password)
    ";
    $pdoStatement = Database::getPDO()->prepare($sql);
    $pdoStatement->bindValue(':first_name', $this->username , PDO::PARAM_STR);
    $pdoStatement->bindValue(':last_name', $this->username , PDO::PARAM_STR);
    $pdoStatement->bindValue(':email', $this->username , PDO::PARAM_STR);
    $pdoStatement->bindValue(':password', $this->username , PDO::PARAM_STR);

    $affectedRows = $pdoStatement->execute();
    $this->id = Database::getPDO()->lastInsertId();

    return $affectedRows;
}
    public static function getLevelNameById($quizId) {
        $sql = "
            SELECT q.*, l.name as level
                FROM questions q, levels l
                WHERE q.id_level = l.id AND q.id_quiz = :quizId
            ";
        $pdoStatement = Database::getPDO()->prepare($sql);
          $pdoStatement->bindValue(':quizId', $quizId );
          $pdoStatement->execute();
          $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, static::class);
          return $results;
    }


    public static function getQuestionsByQuizzId($quizId) {
        $sql = "
            SELECT *, ".self::TABLE_NAME.".id
            FROM ".self::TABLE_NAME."
            LEFT JOIN quizzes
            ON ".self::TABLE_NAME.".id_quiz = quizzes.id
            WHERE quizzes.id = :quizId
            ";
        $pdoStatement = Database::getPDO()->prepare($sql);
        $pdoStatement->bindValue(':quizId', $quizId, PDO::PARAM_INT);
        $pdoStatement->execute();
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        //dump($results);
        return $results;
    }

    public function getMixedProps()
    {
        $props = [
            ['prop1' => $this->prop1],
            ['prop2' => $this->prop2],
            ['prop3' => $this->prop3],
            ['prop4' => $this->prop4],
        ];
        shuffle($props);
        return $props;
    }

    public function getProps($quizIndex) {
      $sql = "
          SELECT prop1, prop2, prop3, prop4
          FROM ".self::TABLE_NAME."
          ";
      $pdoStatement = Database::getPDO()->prepare($sql);
      $pdoStatement->execute();
      $results = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
      return $results;
    }


}

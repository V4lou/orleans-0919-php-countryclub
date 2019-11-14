<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace App\Model;

/**
 *
 */
class TeacherManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'teacher';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * Get all row from database.
     *
     * @return array
     */
    public function selectAllTables(): array
    {
        return $this->pdo->query('
                SELECT * FROM ' . self::TABLE .
            ' JOIN practice p ON teacher.pratique_id = p.id')->fetchAll();
    }
}

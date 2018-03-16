<?php

namespace App\Model\Repository;

/**
 * Class UsersRepository
 *
 * @package App\Model\Repository
 */
class UsersRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected $table = 'Participant';

    public function findIdByEmail($email)
    {
        $sql = "SELECT ID FROM " . $this->getTable() . " WHERE Email = :email";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam('email', $email);
        $stmt->execute();

        return $stmt->fetch();
    }
}

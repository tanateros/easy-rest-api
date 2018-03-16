<?php

namespace App\Model\Repository;

class UserOnSessionRepository extends AbstractRepository
{
    protected $table = 'UserOnSession';
    /**
     * @param $sessionId
     * @param $userEmail
     *
     * @return bool
     */
    public function isExistsUserOnSession($sessionId, $userEmail)
    {
        $sql = <<<EOT
            SELECT uos.ID
            FROM UserOnSession as uos
            INNER JOIN Participant as p
            ON
              (uos.Session_ID = :sessionId
              AND
              p.Email = :userEmail)
EOT;

        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam('sessionId', $sessionId);
        $stmt->bindParam('userEmail', $userEmail);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    /**
     * @param $sessionId
     *
     * @return int
     */
    public function getSessionCount($sessionId)
    {
        $sql = "SELECT ID FROM " . $this->getTable() . " WHERE Session_ID = :sessionId";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam('sessionId', $sessionId);
        $stmt->execute();

        return $stmt->rowCount();
    }

    /**
     * @param $sessionId
     * @param $userEmail
     *
     * @return int
     * @throws \Exception
     */
    public function create($sessionId, $userEmail)
    {
        $this->connect->beginTransaction();
        try {
            $sql = "INSERT INTO " . $this->getTable()
                . " (`ID`, `User_ID`, `Session_ID`) VALUES (NULL, :userEmail, :sessionId)";
            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam('sessionId', $sessionId);
            $stmt->bindParam('userEmail', $userEmail);
            $stmt->execute();

            $this->connect->commit();
        } catch (\Exception $e) {
            $this->connect->rollBack();

            throw new \Exception('Internal error. ' . $e->getMessage());
        }

        return $stmt->rowCount();
    }
}

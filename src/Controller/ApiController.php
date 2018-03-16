<?php

namespace App\Controller;

use App\Http\Response;
use App\Model\Acl\AllowSession;
use App\Model\Acl\AllowTable;
use App\Model\Entity\DataEntity;
use App\Model\Repository\AbstractRepository;
use App\Model\Repository\EntityManager;
use App\Model\Repository\UserOnSessionRepository;

/**
 * Class ApiController
 *
 * @package App\Controller
 */
class ApiController extends AbstractController
{
    /**
     * @return Response
     * @throws \App\Model\Entity\Exception\BadValueException
     */
    public function default()
    {
        $entity = new DataEntity('ok', new \stdClass(), 'Api is available.');
        $data = $entity->getArrayCopy();

        return new Response($data, 'json');
    }

    /**
     * @return Response
     * @throws \App\Model\Entity\Exception\BadValueException
     */
    public function table()
    {
        $table = $this->request->get('table');
        $allowTable = new AllowTable();

        if ($allowTable->isAllow($table)) {
            $status = 'ok';
            $em = new EntityManager();
            /** @var AbstractRepository $stmt */
            $stmt = $em->getRepository($table);
            $id = $this->request->get('id');

            if (is_null($id)) {
                $payload = (object)$stmt->findAll();
            } else {
                $payload = (object)$stmt->find($id);
            }
        } else {
            $status = 'error';
            $payload = null;
        }

        $entity = new DataEntity($status, $payload);
        $data = $entity->getArrayCopy();

        return new Response($data, 'json');
    }

    /**
     * @return Response
     * @throws \App\Model\Entity\Exception\BadValueException
     * @throws \Exception
     */
    public function sessionSubscribe()
    {
        $status = 'ok';
        $payload = null;
        $sessionId = $this->request->get('sessionId');
        $userEmail = $this->request->get('userEmail');
        $em = new EntityManager();
        /** @var UserOnSessionRepository $stmt */
        $stmt = $em->getRepository('UserOnSession');
        $count = $stmt->getSessionCount($sessionId);

        if (AllowSession::isAllow($count)) {
            $existsUserOnSession = $stmt->isExistsUserOnSession($sessionId, $userEmail);
            if ($existsUserOnSession) {
                $status = 'error';
                $message = 'Запись уже существует';
            } else {
                $userId = $em->getRepository('Users')->findIdByEmail($userEmail);
                if (empty($userId['ID'])) {
                    $status = 'error';
                    $message = 'Пользователь с запрашиваемым email не найден';
                } else {
                    $stmt->create($sessionId, $userId['ID']);
                    $message = 'Спасибо, вы успешно записаны!';
                }
            }
        } else {
            $message = 'Извините, все места заняты';
        }

        $entity = new DataEntity($status, $payload, $message);
        $data = $entity->getArrayCopy();

        return new Response($data, 'json');
    }
}

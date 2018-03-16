<?php

namespace App\Model\Entity;
use App\Model\Entity\Exception\BadValueException;
use App\Model\Entity\Exception\PropertyNonExistsException;

/**
 * Class DataEntity
 *
 * @package App\Model\Entity
 */
class DataEntity extends AbstractEntity
{
    /**
     * @var string
     */
    protected $status;

    /**
     * @var \stdClass
     */
    protected $payload;

    /**
     * @var string
     */
    protected $message;

    /**
     * DataEntity constructor.
     *
     * @param string $status
     * @param null   $payload
     * @param null   $message
     *
     * @throws BadValueException
     */
    public function __construct($status = 'ok', $payload = null, $message = null)
    {
        if (!in_array($status, ['ok', 'error'])) {
            throw new BadValueException('status');
        }
        $this->status = $status;

        if (is_null($payload)) {
            $payload = new \stdClass();
        } else if (!is_object($payload)) {
            throw new BadValueException('payload');
        }
        $this->payload = $payload;

        if (!is_null($message)) {
            $this->message = $message;
        }
    }

    /**
     * @param $name
     *
     * @return mixed
     * @throws PropertyNonExistsException
     */
    public function __get($name)
    {
        if (!isset($this->{$name})) {
            throw new PropertyNonExistsException((string)$name);
        }

        return $this->{$name};
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return \stdClass
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}

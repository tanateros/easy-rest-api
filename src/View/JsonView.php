<?php

namespace App\View;

/**
 * Class JsonView
 *
 * @package App\View
 */
class JsonView implements ViewInterface
{
    /**
     * @var mixed
     */
    protected $data;

    /**
     * JsonView constructor.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function output()
    {
        return json_encode($this->data);
    }
}

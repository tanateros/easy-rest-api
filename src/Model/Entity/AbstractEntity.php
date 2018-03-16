<?php

namespace App\Model\Entity;

/**
 * Class AbstractEntity
 *
 * @package App\Entity
 */
abstract class AbstractEntity
{
    /**
     * @param $data
     *
     * @return $this
     */
    public function hydrate($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getArrayCopy() {
        $vars = call_user_func('get_object_vars', $this);

        return $vars;
    }
}

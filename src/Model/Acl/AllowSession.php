<?php

namespace App\Model\Acl;

/**
 * Class AllowSession
 *
 * @package App\Model\Acl
 */
class AllowSession
{
    const SESSION_LIMIT = 3;

    /**
     * @param $table
     *
     * @return bool
     */
    static public function isAllow($count)
    {
        return $count < self::SESSION_LIMIT;
    }
}

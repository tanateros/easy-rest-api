<?php

namespace App\Model\Acl;

/**
 * Class AllowTable
 *
 * @package App\Model\Acl
 */
class AllowTable
{
    /**
     * @var array
     */
    protected $allowPublicTables;

    /**
     * AllowTable constructor.
     */
    public function __construct()
    {
        /**
         * TODO need move this logic in DB table or in config
         */
        $this->allowPublicTables = [
            'News',
            'Session',
        ];
    }

    /**
     * @param $table
     *
     * @return bool
     */
    public function isAllow($table)
    {
        return in_array($table, $this->allowPublicTables);
    }
}

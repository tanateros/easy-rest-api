<?php

namespace App\Controller;

use App\Http\Request;

/**
 * Class AbstractController
 *
 * @package App\Controller
 */
abstract class AbstractController
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * AbstractController constructor.
     *
     * @param Request $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }
}

<?php

namespace App\Http;

class Request
{
    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $uri;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param $key
     *
     * @return null|mixed
     */
    public function get($key)
    {
        if (empty($_GET[$key])) {
            return null;
        }

        return $_GET[$key];
    }

    /**
     * @param $key
     *
     * @return null|mixed
     */
    public function post($key)
    {
        if (empty($_POST[$key])) {
            return null;
        }

        return $_POST[$key];
    }
}

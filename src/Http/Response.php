<?php

namespace App\Http;

use App\View\JsonView;
use App\View\ViewInterface;

/**
 * Class Response
 *
 * @package App\Http
 */
class Response
{
    /**
     * @var mixed
     */
    protected $data;

    /**
     * @var string
     */
    protected $type;

    /**
     * Response constructor.
     *
     * @param        $data
     * @param string $type
     */
    public function __construct($data, $type = "json")
    {
        $this->data = $data;
        $this->type = $type;
    }

    public function send()
    {
        switch ($this->type) {
            case 'json': {
                $viewClass = JsonView::class;

                break;
            }
        }
        /** @var ViewInterface $view */
        $view = new $viewClass($this->data);

        echo $view->output();
    }
}

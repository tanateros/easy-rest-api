<?php

namespace App;

use App\Http\Request;
use App\Http\Response;

/**
 * Class Kernel
 *
 * @package App
 */
class Kernel
{
    /**
     * @param Request $request
     *
     * @throws \Exception
     */
    public function handle($request)
    {
        $routes = parse_ini_file(__DIR__ . "/../config/routes.ini");
        $method = $request->getMethod();
        $uri = $request->getUri();

        $routeFound = null;
        foreach ($routes as $route => $data) {
            if (strpos($route, $uri) !== 0) {
                $routeFound = $route;
            }
        }

        if (is_null($routeFound) || $routes[$route]['method'] !== $method) {
            throw new \Exception("Route not found.");
        }

        $controller = $routes[$route]['controller'];
        $action = $routes[$route]['action'];
        $obj = new $controller($request);
        /** @var Response $response */
        $response = $obj->{$action}();

        return $response; //echo $routes[$uri]['controller'].'::'.$routes[$uri]['action'];
    }
}

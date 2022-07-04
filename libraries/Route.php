<?php

namespace Framework59;

class Route {

    // All available routes
    private static $routes = [];
    /**
     * Adds the route to the core
     *
     * @param string $type
     * @param string $path
     * @param array $controller
     * @param array $params (optional)
     * @return boolean
     */
    public static function create(string $type, string $path, array $controller, array $params = []): bool 
    {
        $count = count(self::$routes);
        self::$routes[] = [
            'type' => $type,
            'path' => $path,
            'controller' => $controller[0],
            'method' => $controller[1],
            'params' => $params
        ];
        return count(self::$routes) > $count ? true : false;
    }

    public static function getRoutes() 
    {
        return count(self::$routes) > 0 ? (object) self::$routes : false; 
    }
    

}
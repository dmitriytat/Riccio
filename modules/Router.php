<?php

/**
 * Class Router
 */
class Router
{
    private $routes = array();

    /**
     * @param Route $route
     */
    public function attachRoute(Route $route)
    {
        $this->routes[$route->pattern] = $route;
    }

    /**
     *
     */
    public function go()
    {
        $path = $_SERVER['REQUEST_URI'];

        $work = null;

        foreach ($this->routes as $pattern => $route) {
            if ($work = preg_match('/^' . $pattern . '$/i', $path)) {
                $route->proceed($path);
                break;
            }
        }

        if (!$work)
            echo 'error 404';
    }
}

/**
 * Class Route
 */
class Route
{
    public $pattern;
    private $action;
    private $method;
    private $parameters;

    /**
     * Route constructor.
     * @param $pattern
     * @param $action
     * @param string $method
     */
    public function __construct($pattern, $action, $method = "GET")
    {
        $this->action = $action;
        $this->method = $method;

        $expressions = array();
        preg_match_all('/\:(\w+)/', $pattern, $expressions);

        $this->parameters = $expressions[1];
        $this->pattern = self::generateRegExp($pattern);
    }

    private static function generateRegExp($pattern)
    {
        return preg_replace('/\\\:\w+/', '(\w+)', preg_quote($pattern, '/'));
    }

    /**
     * @param $path
     */
    public function proceed($path)
    {
        echo forward_static_call(explode('::', $this->action), $this->extractParams($this->pattern, $path));
    }

    /**
     * @param $pattern
     * @param $path
     * @return array
     */
    private function extractParams($pattern, $path)
    {
        $values = array();
        $parameters = array();
        preg_match('/' . $pattern . '/i', $path, $values);

        foreach ($this->parameters as $i => $key) {
            $parameters[$key] = $values[$i + 1];
        }

        return $parameters;
    }
}

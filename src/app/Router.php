<?php

use App\Middlewares\AuthMiddleware;

class Router {
    private $routes = [];
    private $params = [];
    private $middlewares = [];

    /**
     * @param string $file
     * @return Router
     *
     * Load the Router in order to have access to every methods
     * for rooting.
     */
    public static function load(string $file): Router
    {
        $router = new static;
        require_once $file;
        $router->loadMiddlewares();

        return $router;
    }

    /**
     * @param  string $uri        Full route
     * @param  string $controller Controller and action
     * @return void
     *
     * Register a GET route
     */
    public function get(string $uri, string $controller) : void
    {
        $this->routes['GET'][$uri] = $controller;
    }

	/**
     * @param  string $uri        Full route
     * @param  string $controller Controller and action
     * @return void
     *
     * Register a POST route
     */
	public function post($uri, $controller) : void
    {
        $this->routes['POST'][$uri] = $controller;
    }

	/**
     * @param  string $uri        Full route
     * @param  string $method 	  GET or POST
     * @return void
     *
     * Direct based on the URI'S and the method
     */
	public function direct($uri, $method)
    {
        $this->handleMiddlewares();

        if (empty($uri))
        {
            return $this->callAction('Index', 'get');
        }

        if (array_key_exists($uri[0], $this->routes[$method]))
        {
            return $this->callAction(
                ...explode('@', $this->routes[$method][$uri[0]])
            );
        }
        else
        {
            return $this->callAction(
                ...explode('@', $this->routes[$method]['404'])
            );
        }

        throw new Exception('No route defined for this URI.');
    }

    /**
     * @param $controller
     * @param $action
     * @return mixed
     *
     * Call the good controller with the relied actions based on the URI's
     */
	private function callAction($controller, $action)
    {
        $controller = "Controllers\\{$controller}";
        $controller = new $controller;

        return $controller->$action();
    }

    private function loadMiddlewares(): void {
        $this->middlewares = array(
            "App\\Middlewares\\".(new ReflectionClass(AuthMiddleware::class))->getShortName(),
        );
    }

    private function handleMiddlewares()
    {
        foreach ($this->middlewares as $middleware) {
            $middlewareInstance = new $middleware();
            $middlewareInstance->handle();
        }
    }
}
<?php

use App\Middlewares\AuthMiddleware;
use App\Middlewares\PermissionMiddleware;

class Router {
    private $routes = [];
    private $permissions = [];
    private $middlewares = [];
    private $params = [];

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
    public function get(string $uri, string $controller, array $permissions = []) : void
    {
        $this->routes['GET'][$uri] = $controller;
        $this->permissions['GET'][$uri] = $permissions;

    }

	/**
     * @param  string $uri        Full route
     * @param  string $controller Controller and action
     * @return void
     *
     * Register a POST route
     */
	public function post($uri, $controller, array $permissions = []) : void
    {
        $this->routes['POST'][$uri] = $controller;
        $this->permissions['POST'][$uri] = $permissions;

    }

    /**
     * @param  string $uri        Full route
     * @param  string $controller Controller and action
     * @return void
     *
     * Register a DELETE route
     */
    public function delete(string $uri, string $controller, array $permissions = []) : void
    {
        $this->routes['DELETE'][$uri] = $controller;
        $this->permissions['DELETE'][$uri] = $permissions;

    }

    /**
     * @param  string $uri        Full route
     * @param  string $controller Controller and action
     * @return void
     *
     * Register a PUT route
     */
    public function put(string $uri, string $controller, array $permissions = []) : void
    {
        $this->routes['PUT'][$uri] = $controller;
        $this->permissions['PUT'][$uri] = $permissions;

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
        $this->handleMiddlewares($uri, $method);

        if (empty($uri))
        {
            return $this->callAction('Home', 'Index');
        }

        foreach ($this->routes[$method] as $route => $controller) {
            if ($this->isRouteMatch($uri, $route)) {
                $this->extractRouteParams($uri, $route);
                return $this->callAction(
                    ...explode('@', $controller)
                );
            }
        }
        return $this->callAction(
            ...explode('@', $this->routes[$method]['404'])
        );

        throw new Exception('No route defined for this URI.');
    }

    /**
     * Check if the given URI matches the route pattern.
     *
     * @param string $uri
     * @param string $route
     * @return bool
     */
    private function isRouteMatch(string $uri, string $route): bool
    {
        $pattern = preg_replace('/\/{(.*?)}/', '/([a-zA-Z0-9]+)', $route);
        $pattern = str_replace('/', '\/', $pattern);
        $pattern = '/^' . $pattern . '$/';

        return preg_match($pattern, $uri);
    }

    /**
     * Extract the route parameters from the URI.
     *
     * @param string $uri
     * @param string $route
     * @return void
     */
    private function extractRouteParams(string $uri, string $route): void
    {
        $routeParts = explode('/', $route);
        $uriParts = explode('/', $uri);

        foreach ($routeParts as $index => $part) {
            if (strpos($part, '{') !== false && strpos($part, '}') !== false) {
                $paramName = str_replace(['{', '}'], '', $part);
                $paramValue = $uriParts[$index];
                $this->params[$paramName] = $paramValue;
            }
        }
    }

    public function getParams(): array
    {
        return $this->params;
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

        $reflectionMethod = new ReflectionMethod($controller, $action);
        $methodParameters = $reflectionMethod->getParameters();
        $methodArguments = [];

        foreach ($methodParameters as $parameter) {
            $parameterName = $parameter->getName();
            if (isset($this->params[$parameterName])) {
                $methodArguments[] = $this->params[$parameterName];
            } else {
                if ($parameter->isDefaultValueAvailable()) {
                    $methodArguments[] = $parameter->getDefaultValue();
                } else {
                    throw new Exception("Missing parameter: $parameterName");
                }
            }
        }

        return $reflectionMethod->invokeArgs($controller, $methodArguments);
    }

    private function loadMiddlewares(): void {
        $this->middlewares = array(
            "App\\Middlewares\\".(new ReflectionClass(AuthMiddleware::class))->getShortName(),
            "App\\Middlewares\\".(new ReflectionClass(PermissionMiddleware::class))->getShortName(),

        );
    }

    private function handleMiddlewares($uri, $method)
    {
        foreach ($this->middlewares as $middleware) {
            $middlewareInstance = new $middleware();
            if ($middlewareInstance instanceof PermissionMiddleware) {
                if (array_key_exists($uri, $this->routes[$method]) && isset($this->permissions[$method][$uri])) {
                    $permissions = $this->permissions[$method][$uri];
                    $middlewareInstance->handle($permissions);
                }
            } else {
                $middlewareInstance->handle();
            }
        }
    }
}
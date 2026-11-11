<?php declare(strict_types=1);

namespace App\Classes;

class Router
{

    protected array $routes = [];
    protected string $basePath = '';

    public function add(string $method, string $route, string $controller): void
    {
        $this->routes[] = [
            'method' => $method,
            'route' => $route,
            'controller' => $controller
        ];
    }

    public function get(string $route, string $controller): void
    {
        $this->add('GET', $route, $controller);
    }

    public function post(string $route, string $controller): void
    {
        $this->add('POST', $route, $controller);
    }

    public function delete(string $route, string $controller): void
    {
        $this->add('DELETE', $route, $controller);
    }

    public function patch(string $route, string $controller): void
    {
        $this->add('PATCH', $route, $controller);
    }

    public function put(string $route, string $controller): void
    {
        $this->add('PUT', $route, $controller);
    }

    /**
     *  Matches a given Request URL against stored routes
     *
     *  @param string $requestUrl
     *  @param string $requestMethod
     *  @return string|bool Target URL on successful match, false on no match
     */
    public function match(?string $requestUrl = null, ?string $requestMethod = null): string|bool
    {
        // Set request URL if not given as parameter
        if ($requestUrl === null) {
            $requestUrl = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
        }

        // Strip base path from request URL
        $requestUrl = substr($requestUrl, strlen($this->basePath));

        // Strip query string (?foo=bar) from request URL
        $strpos = strpos($requestUrl, '?');
        if ($strpos !== false) {
            $requestUrl = substr($requestUrl, 0, $strpos);
        }

        // Set request method if it is not given as parameter
        if ($requestMethod === null) {
            $requestMethod = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
        }

        foreach($this->routes as $handler) {
            // list($route, $target, $method) = $handler;
            $route = $handler['route'];
            $target = $handler['controller'];
            $method = $handler['method'];

            $methodMatch = (stripos($method, $requestMethod) !== false);

            // If method did not match continue to next route
            if (!$methodMatch) continue;
            if ($route === $requestUrl) return $target;
        }

        return false;
    }

}

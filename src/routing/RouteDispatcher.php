<?php declare(strict_types=1);

namespace App;

use App\Classes\Router;
use RuntimeException;

class RouteDispatcher
{

    protected $controller;
    protected $method;
    protected $match;
    protected $uri;

    public function __construct(Router $router)
    {
        // Extract URI from the URL
        if (isset($_SERVER['REQUEST_URI'])) {
            $this->uri = parse_url($_SERVER['REQUEST_URI'])['path'];
        }

        $this->match = $router->match($this->uri);

        if ($this->match) {
            list($this->controller, $this->method) = explode('@', $this->match);

            if (is_callable([new $this->controller, $this->method])) {
                call_user_func_array(
                    [new $this->controller, $this->method],
                    []
                );
            } else {
                throw new RuntimeException("The method {$this->method} is not defined in {$this->controller}");
            }
        } else {
            // header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
            http_response_code(404);
            echo view('errors/404');
        }
    }

}

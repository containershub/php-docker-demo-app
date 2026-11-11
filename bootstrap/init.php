<?php

require_once __DIR__ . '/../src/config/_env.php';

require_once __DIR__ . '/../src/routing/routes.php';

// Call the route dispatcher
new \App\RouteDispatcher($router);

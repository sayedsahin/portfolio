<?php
	// Source: https://github.com/nikic/FastRoute

	$dispatcher = FastRoute\cachedDispatcher(function(FastRoute\RouteCollector $route) {
	    require_once 'config/routes.php';
	}, [
	    'cacheFile' => 'store/cache/route.cache', /* required */
	    'cacheDisabled' => DEBUG_MODE,     /* optional, enabled by default */
	]);

	// Fetch method and URI from somewhere
	$httpMethod = $_SERVER['REQUEST_METHOD'];
	$uri = $_SERVER['REQUEST_URI'];

	// Strip query string (?foo=bar) and decode URI
	if (false !== $pos = strpos($uri, '?')) {
	    $uri = substr($uri, 0, $pos);
	}
	$uri = rawurldecode($uri);

	$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
	switch ($routeInfo[0]) {
	    case FastRoute\Dispatcher::NOT_FOUND:
	        // ... 404 Not Found
	    	exit('404 not found');	
	        break;
	    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
	        $allowedMethods = $routeInfo[1];
	        exit('method type error');
	        // ... 405 Method Not Allowed
	        break;
	    case FastRoute\Dispatcher::FOUND:
	        $handler = $routeInfo[1];
	        $vars = $routeInfo[2];

	        call_user_func_array([new $handler[0], $handler[1]], $vars);
	        break;
	}
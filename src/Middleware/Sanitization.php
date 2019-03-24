<?php

namespace MiddlewaresPsr7\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class Sanitization
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        $filteredPostData = [];
        foreach ($request->getParams() as $key => $params) {
            $filteredPostData[$key] = trim($params);
        }
        $request = $request->withParsedBody($filteredPostData);
        return $next($request, $response);
    }
}
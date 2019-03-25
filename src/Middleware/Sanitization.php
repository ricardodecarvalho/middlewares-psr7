<?php

namespace MiddlewaresPsr7\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class Sanitization
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        $filteredPostData = [];
        if (count($request->getParams()) > 0) {
            foreach ($request->getParams() as $key => $params) {
                if (!empty($params) && !is_array($params)) {
                    $filteredPostData[$key] = trim($params);
                } else {
                    $filteredPostData[$key] = $params;
                }
            }
        }
        $request = $request->withParsedBody($filteredPostData);
        return $next($request, $response);
    }
}
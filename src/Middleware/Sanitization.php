<?php

namespace MiddlewaresPsr7\Sanitization;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class PostData
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
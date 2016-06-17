<?php

namespace App\Http\OAuth;

use Closure;
use Illuminate\Http\JsonResponse;
use League\OAuth2\Server\Exception\OAuthException;

/**
 * Class OAuthExceptionHandlerMiddleware
 * @package App\Http\OAuth
 */
class OAuthExceptionHandlerMiddleware extends \LucaDegasperi\OAuth2Server\Middleware\OAuthExceptionHandlerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request  $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $response = $next($request);
            // Was an exception thrown? If so and available catch in our middleware
            if (isset($response->exception) && $response->exception) {
                throw $response->exception;
            }

            return $response;
        } catch (OAuthException $e) {
            $data = [
                'error' => $e->errorType,
                'error_description' => $e->getMessage(),
            ];

            $headers = [];
            foreach ($e->getHttpHeaders() as $v) {
                $parts = explode(':', $v);
                if (count($parts) > 1) {
                    $headers[$parts[0]] = $parts[1];
                }
            }

            $headers['Access-Control-Allow-Origin'] = '*';

            $allowMethods = strtoupper($request->method());
            $headers['Access-Control-Allow-Methods'] = $allowMethods;

            return new JsonResponse($data, $e->httpStatusCode, $headers);
        }
    }
}
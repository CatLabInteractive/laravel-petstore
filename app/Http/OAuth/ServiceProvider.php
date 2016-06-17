<?php

namespace App\Http\OAuth;

use Illuminate\Contracts\Container\Container as Application;
use Illuminate\Foundation\Application as LaravelApplication;
use Laravel\Lumen\Application as LumenApplication;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\ResourceServer;
use League\OAuth2\Server\Storage\AccessTokenInterface;
use League\OAuth2\Server\Storage\AuthCodeInterface;
use League\OAuth2\Server\Storage\ClientInterface;
use League\OAuth2\Server\Storage\RefreshTokenInterface;
use League\OAuth2\Server\Storage\ScopeInterface;
use League\OAuth2\Server\Storage\SessionInterface;
use LucaDegasperi\OAuth2Server\Middleware\CheckAuthCodeRequestMiddleware;
use LucaDegasperi\OAuth2Server\Middleware\OAuthClientOwnerMiddleware;
use LucaDegasperi\OAuth2Server\Middleware\OAuthMiddleware;
use LucaDegasperi\OAuth2Server\Middleware\OAuthUserOwnerMiddleware;
use LucaDegasperi\OAuth2Server\OAuth2ServerServiceProvider;

class ServiceProvider extends OAuth2ServerServiceProvider
{
    /**
     * Register the Authorization server with the IoC container.
     *
     * @param \Illuminate\Contracts\Container\Container $app
     *
     * @return void
     */
    public function registerAuthorizer(Application $app)
    {
        $app->singleton('oauth2-server.authorizer', function ($app) {
            $config = $app['config']->get('oauth2');
            $issuer = $app->make(AuthorizationServer::class)
                ->setClientStorage($app->make(ClientInterface::class))
                ->setSessionStorage($app->make(SessionInterface::class))
                ->setAuthCodeStorage($app->make(AuthCodeInterface::class))
                ->setAccessTokenStorage($app->make(AccessTokenInterface::class))
                ->setRefreshTokenStorage($app->make(RefreshTokenInterface::class))
                ->setScopeStorage($app->make(ScopeInterface::class))
                ->requireScopeParam($config['scope_param'])
                ->setDefaultScope($config['default_scope'])
                ->requireStateParam($config['state_param'])
                ->setScopeDelimiter($config['scope_delimiter'])
                ->setAccessTokenTTL($config['access_token_ttl']);

            // add the supported grant types to the authorization server
            foreach ($config['grant_types'] as $grantIdentifier => $grantParams) {
                $grant = $app->make($grantParams['class']);
                $grant->setAccessTokenTTL($grantParams['access_token_ttl']);

                if (array_key_exists('callback', $grantParams)) {
                    list($className, $method) = array_pad(explode('@', $grantParams['callback']), 2, 'verify');
                    $verifier = $app->make($className);
                    $grant->setVerifyCredentialsCallback([$verifier, $method]);
                }

                if (array_key_exists('auth_token_ttl', $grantParams)) {
                    $grant->setAuthTokenTTL($grantParams['auth_token_ttl']);
                }

                if (array_key_exists('refresh_token_ttl', $grantParams)) {
                    $grant->setRefreshTokenTTL($grantParams['refresh_token_ttl']);
                }

                if (array_key_exists('rotate_refresh_tokens', $grantParams)) {
                    $grant->setRefreshTokenRotation($grantParams['rotate_refresh_tokens']);
                }

                $issuer->addGrantType($grant, $grantIdentifier);
            }

            $checker = $app->make(ResourceServer::class);

            $authorizer = new Authorizer($issuer, $checker);
            $authorizer->setRequest($app['request']);
            $authorizer->setTokenType($app->make($config['token_type']));

            $app->refresh('request', $authorizer, 'setRequest');

            return $authorizer;
        });

        $app->alias('oauth2-server.authorizer', Authorizer::class);
    }
}
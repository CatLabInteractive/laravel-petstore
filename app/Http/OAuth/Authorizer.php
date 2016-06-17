<?php

namespace App\Http\OAuth;

/**
 * Class Authorizer
 * @package App\Http\OAuth
 */
class Authorizer extends \LucaDegasperi\OAuth2Server\Authorizer
{
    /**
     * Issue an auth code.
     *
     * @param string $ownerType the auth code owner type
     * @param string $ownerId the auth code owner id
     * @param array $params additional parameters to merge
     *
     * @return string the auth code redirect url
     */
    public function issueImplicitAccessToken($ownerType, $ownerId, $params = [])
    {
        $params = array_merge($this->authCodeRequestParams, $params);

        return $this->issuer->getGrantType('implicit')->issueImplicitAccessToken($ownerType, $ownerId);
    }
}
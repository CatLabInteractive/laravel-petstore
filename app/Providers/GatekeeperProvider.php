<?php

namespace App\Providers;

use CatLab\Gatekeeper\Contracts\Identity;
use Gatekeeper;

/**
 * Class GatekeeperProvider
 * @package App\Providers
 */
class GatekeeperProvider extends \CatLab\Gatekeeper\Laravel\GatekeeperProvider
{
    /**
     * 
     */
    protected function registerPolicies()
    {
        Gatekeeper::define('access-gatekeeper', function(Identity $identity) {
            return true;
        });

        // Add policies for all models
        Gatekeeper::addPolicy(User::class, UserPolicy::class);
    }
}
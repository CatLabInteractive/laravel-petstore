<?php

namespace App\Providers;

use App\Models\Pet;
use App\Models\Photo;
use App\Models\User;
use App\Policies\PetPolicy;
use App\Policies\PhotoPolicy;
use App\Policies\UserPolicy;
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
        Gatekeeper::addPolicy(Pet::class, PetPolicy::class);
        Gatekeeper::addPolicy(Photo::class, PhotoPolicy::class);
    }
}
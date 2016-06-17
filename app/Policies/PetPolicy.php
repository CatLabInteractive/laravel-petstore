<?php

namespace App\Policies;

use CatLab\Gatekeeper\Contracts\Identity;
use CatLab\Gatekeeper\Laravel\Contracts\UserIdentity;

/**
 * Class PetPolicy
 * @package App\Policies
 */
class PetPolicy
{
    /**
     * @param Identity $identity
     * @return bool
     */
    public function index(Identity $identity)
    {
        return $identity instanceof UserIdentity;
    }

    /**
     * @param Identity $identity
     * @return bool
     */
    public function show(Identity $identity)
    {
        return $identity instanceof UserIdentity;
    }
}
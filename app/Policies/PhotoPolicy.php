<?php

namespace App\Policies;

use CatLab\Gatekeeper\Contracts\Identity;
use CatLab\Gatekeeper\Laravel\Models\UserIdentity;

/**
 * Class PhotoPolicy
 * @package App\Policies
 */
class PhotoPolicy
{
    /**
     * @param Identity $identity
     * @return bool
     */
    public function index(Identity $identity)
    {
        return $identity instanceof UserIdentity;
    }
}
<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\Organisation;
use App\Models\Page;
use App\Models\User;
use CatLab\Gatekeeper\Contracts\Identity;
use CatLab\Gatekeeper\Laravel\Contracts\UserIdentity;

/**
 * Class UserPolicy
 * @package App\Policies
 */
class UserPolicy
{
    /**
     * @param Identity $identity
     * @param User $user
     * @return bool|null
     */
    public function show(Identity $identity, User $user)
    {
        if ($identity instanceof UserIdentity) {
            if ($identity->getUser()->id === $user->id) {
                return true;
            }
        }
        return null;
    }

    /**
     * @param Identity $identity
     * @return bool
     */
    public function index(Identity $identity)
    {
        return true;
    }
}
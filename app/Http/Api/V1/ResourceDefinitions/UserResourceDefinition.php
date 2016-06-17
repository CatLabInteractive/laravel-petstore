<?php

namespace App\Http\Api\V1\ResourceDefinitions;

use App\Models\User;
use CatLab\Charon\Models\ResourceDefinition;

/**
 * Class UserResourceDefinition
 * @package App\Http\Api\V1\ResourceDefinitions
 */
class UserResourceDefinition extends ResourceDefinition
{
    public function __construct()
    {
        parent::__construct(User::class);

        $this
            ->identifier('id')
                ->int()

            ->field('name')
                ->required()
                ->visible(true)
                ->writeable()

            ->field('email')
                ->visible(true)
        ;
    }
}
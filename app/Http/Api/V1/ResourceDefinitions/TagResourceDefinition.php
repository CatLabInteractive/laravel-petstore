<?php

namespace App\Http\Api\V1\ResourceDefinitions;

use App\Models\Tag;
use CatLab\Charon\Models\ResourceDefinition;

/**
 * Class TagResourceDefinition
 * @package App\Http\Api\V1\ResourceDefinitions
 */
class TagResourceDefinition extends ResourceDefinition
{
    /**
     * TagDefinition constructor.
     */
    public function __construct()
    {
        parent::__construct(Tag::class);

        $this
            ->identifier('id')
                ->int()
                ->display('tag-id')

            ->field('name')
                ->required()
                ->visible(true, true)
        ;
    }
}
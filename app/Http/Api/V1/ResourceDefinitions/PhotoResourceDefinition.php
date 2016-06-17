<?php

namespace App\Http\Api\V1\ResourceDefinitions;

use App\Models\Photo;
use CatLab\Charon\Models\ResourceDefinition;

/**
 * Class PhotoResourceDefinition
 * @package App\Http\Api\V1\ResourceDefinitions
 */
class PhotoResourceDefinition extends ResourceDefinition
{
    /**
     * PhotoDefinition constructor.
     */
    public function __construct()
    {
        parent::__construct(Photo::class);

        $this
            ->identifier('id')
            ->display('photo-id')

            ->field('url')
            ->visible(true, true)
            ->writeable()
        ;
    }
}
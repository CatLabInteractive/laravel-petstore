<?php

namespace App\Http\Api\V1\ResourceDefinitions;

use App\Models\Category;
use CatLab\Charon\Models\ResourceDefinition;

/**
 * Class CategoryResourceDefinition
 * @package App\Http\Api\V1\ResourceDefinitions
 */
class CategoryResourceDefinition extends ResourceDefinition
{
    /**
     * CategoryDefinition constructor.
     */
    public function __construct()
    {
        parent::__construct(Category::class);

        $this
            ->identifier('id')
                ->int()

            ->field('name')
                ->string()
                ->required()
                ->visible(true, true)

            ->field('description')
                ->display('category-description')
                ->visible()
        ;
    }
}
<?php

namespace App\Http\Api\V1\ResourceDefinitions;

use App\Http\Api\V1\Validators\PetValidator;
use App\Models\Pet;
use CatLab\Charon\Models\ResourceDefinition;

/**
 * Class PetResourceDefinition
 * @package App\Http\Api\V1\ResourceDefinitions
 */
class PetResourceDefinition extends ResourceDefinition
{
    public function __construct()
    {
        parent::__construct(Pet::class);

        $this
            ->identifier('id')
                ->int()

            ->field('name')
                ->writeable()
                ->required()
                ->visible(true)

            ->relationship('category', CategoryResourceDefinition::class)
                ->one()
                ->visible()
                ->expandable()
                ->expanded()
                ->linkable()

            ->relationship('photos', PhotoResourceDefinition::class)
                ->many()
                ->visible()
                ->expandable()
                ->expanded()
                ->writeable()
                ->records(3)
                ->url('api/v1/pets/{model.id}/photos')

            ->relationship('tags', TagResourceDefinition::class)
                ->many()
                ->linkable()
                ->expandable()
                ->expanded()
                ->visible()

            ->field('status')
                ->enum([ Pet::STATUS_AVAILABLE, Pet::STATUS_ENDING, Pet::STATUS_SOLD ])
                ->visible()

            ->validator(new PetValidator())
        ;
    }
}
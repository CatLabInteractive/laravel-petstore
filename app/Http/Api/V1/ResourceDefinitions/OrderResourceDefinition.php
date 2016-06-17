<?php

namespace App\Http\Api\V1\ResourceDefinitions;

use App\Models\Order;
use CatLab\Charon\Models\ResourceDefinition;

/**
 * Class OrderResourceDefinition
 * @package App\Http\Api\V1\ResourceDefinitions
 */
class OrderResourceDefinition extends ResourceDefinition
{
    /**
     * OrderResourceDefinition constructor.
     */
    public function __construct()
    {
        parent::__construct(Order::class);

        $this
            ->identifier('id')
                ->int()

            ->field('complete')
                ->bool()

            ->relationship('pet', PetResourceDefinition::class)
                ->one()
                ->required()
                ->linkable()

            ->field('quantity')
                ->int()

            ->field('shipDate')
                ->datetime()

            ->field('status')
                ->enum([ 'placed', 'approved', 'delivered' ])
        ;
    }
}
<?php

namespace App\Http\Api\V1\Controllers;

use App\Http\Api\V1\ResourceDefinitions\PetResourceDefinition;
use App\Models\Pet;
use CatLab\Charon\Collections\RouteCollection;

/**
 * Class PetController
 * @package App\Http\Api\V1\Controllers
 */
class PetController extends Base\ResourceController
{
    /**
     * @param RouteCollection $routes
     */
    public static function setRoutes(RouteCollection $routes)
    {
        $routes->group(function(RouteCollection $routes)
        {
            $routes->tag('pet');

            $routes
                ->get('pets', 'PetController@index')
                ->returns()->many(PetResourceDefinition::class)
                ->summary('Find pets')
            ;

            $routes
                ->get('pets/{id}', 'PetController@show')
                ->parameters()->path('id')->required()->int()
                ->returns()->one(PetResourceDefinition::class)
                ->summary('Show a pet')
            ;
        });
    }

    /**
     * PetController constructor.
     */
    public function __construct()
    {
        parent::__construct(PetResourceDefinition::class);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $this->authorize('index');
        return $this->outputList(Pet::query());
    }

    /**
     * @param $petId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($petId)
    {
        /** @var Pet $pet */
        $pet = Pet::find($petId);
        if (!$pet) {
            return $this->notFound($petId, Pet::class);
        }

        $this->authorize('show', $pet);
        return $this->output($pet);
    }
}
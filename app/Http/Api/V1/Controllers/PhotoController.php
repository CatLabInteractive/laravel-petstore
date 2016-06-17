<?php

namespace App\Http\Api\V1\Controllers;

use App\Http\Api\V1\ResourceDefinitions\PhotoResourceDefinition;
use App\Models\Pet;
use CatLab\Charon\Collections\RouteCollection;

/**
 * Class PhotoController
 * @package App\Http\Api\V1\Controllers
 */
class PhotoController extends Base\ResourceController
{
    /**
     * @param RouteCollection $routes
     */
    public static function setRoutes(RouteCollection $routes)
    {
        $routes->group(function(RouteCollection $routes)
        {
            $routes->tag('photos');

            $routes
                ->get('pets/{id}/photos', 'PhotoController@index')
                ->parameters()->path('id')->int()->required()
                ->returns()->many(PhotoResourceDefinition::class)
                ->summary('Show all photos of a pet')
            ;
        });
    }

    /**
     * PhotoController constructor.
     */
    public function __construct()
    {
        parent::__construct(PhotoResourceDefinition::class);
    }

    /**
     * @param $petId
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($petId)
    {
        /** @var Pet $pet */
        $pet = Pet::find($petId);
        $this->authorize('index', $pet);

        return $this->outputList($pet->photos());
    }
}
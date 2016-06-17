<?php

namespace App\Http\Api\V1\Controllers;

use App\Http\Api\V1\ResourceDefinitions\UserResourceDefinition;
use App\Models\User;
use CatLab\Charon\Collections\RouteCollection;
use Gatekeeper;

/**
 * Class UserController
 * @package App\Http\Api\V1\Controllers
 */
class UserController extends Base\ResourceController
{
    const USER_ME = 'me';
    
    /**
     * Set all routes for this controller
     * @param RouteCollection $routes
     */
    public static function setRoutes(RouteCollection $routes)
    {
        $routes->group(function(RouteCollection $routes)
        {
            $routes->tag('users');
            
            $routes
                ->get('users/{id}', 'UserController@show')
                ->parameters()->path('id')->required()
                ->returns()->one(UserResourceDefinition::class)
                ->summary('Return a user object');
        });
    }

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        parent::__construct(UserResourceDefinition::class);
    }

    /**
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = $this->getUser($id);
        if (!$user) {
            return $this->notFound($id, User::class);
        }

        return $this->output($user);
    }

    /**
     * @param string $id
     * @return mixed
     */
    private function getUser($id)
    {
        if ($id === self::USER_ME) {
            return Gatekeeper::getIdentity()->getUser();
        } else {
            return User::find($id);
        }
    }
}
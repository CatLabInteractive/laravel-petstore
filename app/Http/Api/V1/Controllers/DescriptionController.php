<?php

namespace App\Http\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use CatLab\Charon\Collections\RouteCollection;
use CatLab\Charon\Swagger\Authentication\OAuth2Authentication;
use CatLab\Charon\Swagger\SwaggerBuilder;

use Request;
use Response;

/**
 * Class DescriptionController
 * @package App\Http\Api\V1\Controllers
 */
class DescriptionController extends Controller
{
    /**
     * @return RouteCollection
     */
    public function getRouteCollection() : RouteCollection
    {
        return include __DIR__ . '/../routes.php';
    }

    /**
     * @param $format
     * @return \Illuminate\Http\Response
     */
    public function description($format)
    {
        switch ($format) {
            case 'txt':
            case 'text':
                return $this->textResponse();
                break;

            case 'json':
                return $this->swaggerResponse();
                break;
        }
    }

    /**
     * @return \Illuminate\Http\Response
     */
    protected function textResponse()
    {
        $routes = $this->getRouteCollection();
        return Response::make($routes->__toString(), 200, [ 'Content-type' => 'text/text' ]);
    }

    /**
     * @return mixed
     */
    protected function swaggerResponse()
    {
        $builder = new SwaggerBuilder(Request::getHttpHost(), '/');

        $builder
            ->setTitle('Laravel Charon REST API')
            ->setDescription('API built with Laravel and Charon')
            ->setContact('CatLab Interactive', 'http://www.catlab.eu/', 'info@catlab.be')
            ->setVersion('1.0');


        foreach ($this->getRouteCollection()->getRoutes() as $route) {
            $builder->addRoute($route);
        }

        /*
         * Authentication protocols
         * (note that this is only to document these; must be enforced in the controllers / middleware)
         */
        $oauth2 = new OAuth2Authentication('oauth2');
        $oauth2
            ->setAuthorizationUrl(url('oauth/authorize'))
            ->setFlow('implicit')
            ->addScope('full', 'Full access');

        $builder->addAuthentication($oauth2);

        return $builder->build();
    }
}
<?php

namespace App\Http\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use CatLab\Charon\Collections\RouteCollection;
use CatLab\Charon\Models\SwaggerBuilder;
use Request;

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
        return include __DIR__ . '/../../routes.php';
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
        return \Response::make($routes->__toString(), 200, [ 'Content-type' => 'text/text' ]);
    }

    /**
     * @return mixed
     */
    protected function swaggerResponse()
    {
        $builder = new SwaggerBuilder(Request::getHttpHost(), '/');

        $builder
            ->setTitle('Diekeure Boek-E')
            ->setDescription('Boek-E REST API')
            ->setContact('Epyc NV', 'http://www.epyc.be/', 'thijs@epyc.be')
            ->setVersion('1.0');


        foreach ($this->getRouteCollection()->getRoutes() as $route) {
            $builder->addRoute($route);
        }

        return $builder->build();
    }
}
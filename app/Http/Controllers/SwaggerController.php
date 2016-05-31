<?php

namespace App\Http\Controllers;

use Response;

/**
 * Class SwaggerController
 * @package App\Http\Controllers
 */
class SwaggerController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function swagger()
    {
        $parameters = [];

        $parameters['swagger_endpoint'] = url('api/v1/description.json');

        return Response::view('api.swagger', $parameters);
    }
}
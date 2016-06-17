<?php

namespace App\Http\Controllers;

use Config;
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
        $parameters['oauth2_client_id'] = Config::get('oauth2.swagger-ui.client_id');

        return Response::view('api.swagger', $parameters);
    }
}
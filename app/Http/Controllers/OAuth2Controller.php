<?php

namespace App\Http\Controllers;

use App;
use Auth;
use Authorizer;
use Redirect;
use Request;
use Response;
use View;

/**
 * Class OAuth2Controller
 * @package App\Http\Controllers
 */
class OAuth2Controller extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function authorizeOauth2()
    {
        // Check for reset parameter
        if (Request::input('reset')) {
            Auth::logout();

            $input = Request::input();
            unset ($input['reset']);

            $url = Request::url() . '?' . http_build_query($input);
            return redirect($url);
        }

        if (!Auth::check()) {
            return redirect()->guest('auth/login');
        }

        $authParams = Authorizer::getAuthCodeRequestParams();

        $formParams = array_except($authParams,'client');
        $formParams['client_id'] = $authParams['client']->getId();

        $formParams['scope'] = implode(config('oauth2.scope_delimiter'), array_map(function ($scope) {
            return $scope->getId();
        }, $authParams['scopes']));

        return View::make('oauth2.authorize', ['params' => $formParams, 'client' => $authParams['client']]);
    }

    /**
     * @return Response
     */
    public function processAuthorization()
    {
        $params = Authorizer::getAuthCodeRequestParams();
        $params['user_id'] = Auth::user()->id;
        $redirectUri = '/';

        // If the user has allowed the client to access its data, redirect back to the client with an auth code.
        if (Request::has('approve')) {
            return $this->approve();
        }

        // If the user has denied the client to access its data, redirect back to the client with an error message.
        if (Request::has('deny')) {
            $redirectUri = Authorizer::authCodeRequestDeniedRedirectUri();
        }

        return Redirect::to($redirectUri);
    }

    /**
     * @return Response
     */
    public function accessToken()
    {
        return Response::json(Authorizer::issueAccessToken());
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    private function approve()
    {
        $params = Authorizer::getAuthCodeRequestParams();
        $params['user_id'] = Auth::user()->id;

        if ($params['response_type'] === 'token') {
            $request = App::make('request');
            $request->request->set('grant_type', 'implicit');
            Authorizer::setRequest($request);
            $redirectUri = Authorizer::issueImplicitAccessToken('user', $params['user_id'], $params);
        } else {
            $redirectUri = Authorizer::issueAuthCode('user', $params['user_id'], $params);
        }

        return Redirect::to($redirectUri);
    }
}
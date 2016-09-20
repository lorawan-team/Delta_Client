<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {

    $query = http_build_query([
        'client_id' => '4',
        'redirect_uri' => 'http://deltaclient.dev/callback',
        'response_type' => 'code',
        'scope' => ''
    ]);

    return redirect('http://deltasecure.dev/oauth/authorize?'.$query);
});

Route::get('/callback', function (Illuminate\Http\Request $request) {
    $http = new \GuzzleHttp\Client;

    $response = $http->post('http://deltasecure.dev/oauth/token', [
        'form_params' => [
            'client_id' => '4',
            'client_secret' => 'fV0AJ649OYdjG1JpO4KJr42LdEmLDKal78FGA1L9',
            'grant_type' => 'authorization_code',
            'redirect_uri' => 'http://deltaclient.dev/callback',
            'code' => $request->code,
        ],
    ]);
    return json_decode((string) $response->getBody(), true);
});

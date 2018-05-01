<?php namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class ApiAuthController extends Controller
{

    private $client;

    public function __construct()
    {
        $this->client = DB::table('oauth_clients')->where('password_client', 1)->first();
    }

    public function authenticate(Request $request)
    {

        // return 'asdasd';
        $rules = [
            'username' => 'required|email',
            'password' => 'required|string',
        ];

        request()->validate($rules);

        $request->request->add([
            'username' => $request->username,
            'password' => $request->password,
            'grant_type' => 'password',
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'scope' => '*'
        ]);

        $proxy = Request::create(
            'oauth/token',
            'POST'
        );

        return Route::dispatch($proxy);
    }
}

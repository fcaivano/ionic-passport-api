<?php namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

use App\Models\User;

class ApiAuthController extends Controller
{

    private $client;

    public function __construct()
    {
        $this->client = DB::table('oauth_clients')->where('password_client', 1)->first();
    }

    public function authenticate(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|string',
        ];

        request()->validate($rules);

        $request->request->add([
            'username' => $request->email,
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

    public function register(Request $request)
    {

        // return $this->response->errorInternal('Error occured while saving User');
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ];

        request()->validate($rules);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        if($user->save()) {

            $request->request->add([
                'username' => $request->email,
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

        } else {
            return $this->response->errorInternal('Error occured while saving User');
        }
    }

    // $user = new User();
    //     $user->name = $request->get('last_name');
    //     $user->email = $request->get('last_name');
    //     $user->password = bcrypt($request->get('password'));
    //     //$user->phone_number = $request->get('phone');
    //     //$user->address = $request->get('address');
    //     if ($user->save()) {
    //         $user->roles()->sync($request->get('role_ids', []));
    //         return $this->response->item($user, new UserTransformer());
    //     } else {
    //         return $this->response->errorInternal('Error occured while saving User');
    //     }
}

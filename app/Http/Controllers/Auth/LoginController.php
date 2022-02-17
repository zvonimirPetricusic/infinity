<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Settings;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    protected function validateLogin(Request $request)
    {
        $subdomain = explode('.', $_SERVER['HTTP_HOST'])[0];
        $settings = DB::select('SELECT id AS company_id FROM settings WHERE subdomain = :subdomain LIMIT 1',  ['subdomain' => $subdomain]);
        $company_id = false;
        foreach($settings as $res){
            $company_id = $res->company_id;
        }

        $this->validate($request, [
            $this->username() => 'exists:users,' . $this->username() . ',company_id,' . $company_id . '',
            'password' => 'required|string',
        ]);
    }


    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $subdomain = explode('.', $_SERVER['HTTP_HOST'])[0];
        $settings = DB::select('select * from settings where subdomain = :subdomain',  ['subdomain' => $subdomain]);

        if(empty($settings)){
            header("Location: https://google.com");
            die;
        }
        $this->middleware('guest')->except('logout');
    }

}

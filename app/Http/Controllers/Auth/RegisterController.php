<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Model\Requests\Auth\UserRegisterPostRequest;
use App\Service\Contracts\IAuthService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Collection;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    private $authService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(IAuthService $authService)
    {
        $this->middleware('guest');

        $this->authService = $authService;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \App\Model\Requests\Auth\UserRegisterPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function register(UserRegisterPostRequest $request)
    {
        event(new Registered($user = $this->create($request->validatedIntoCollection())));

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  \Illuminate\Support\Collection  $data
     * @return \App\Model\DB\User
     */
    protected function create(Collection $data)
    {
        return $this->authService->RegisterUser($data);
    }
}
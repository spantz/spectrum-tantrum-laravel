<?php

namespace App\Http\Controllers\Auth;

use App\Models\Factory\UserFactory;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Util\ConversionUtil;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
     * @var UserFactory
     */
    private $factory;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function __construct(UserFactory $factory)
    {
        $this->middleware('guest');
        $this->factory = $factory;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'expected_speed' => 'required|integer'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $factory = $this->factory;
        /** @var User $user */
        $user = $factory
            ->make([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'token' => $factory->getRepository()
                    ->generateUniqueToken(),
                'expected_speed' => ConversionUtil::convertMegabitsToKilobytes($data['expected_speed'])
            ]);

        return $user;
    }
}

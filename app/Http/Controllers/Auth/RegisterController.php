<?php

namespace App\Http\Controllers\Auth;

use App\Entity\User\UserDetails;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Entity\User\User;
use App\Traits\EmailCommand;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    use EmailCommand;
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $password = $this->generatePassword();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($password),
            'role'=>'student'
        ]);
        UserDetails::create([
            'user_id'=>$user->id
        ]);
        $msg = "
            <p>Сәлем {$data['name']}</p>
            <p>Сіздің жаңа құпиясөзіңіз : <strong>{$password}</strong></p>
        ";
        $this->sendEmail($data['email'],$msg,'Zhanbolat Academy');
        return $user;
    }
}

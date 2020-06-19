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
        $msg = "<p>Сәлем құрметті студент !!!</p>

            <p>Сіз, Zhanbolat Academy платформасына тіркелдіңіз.</p>

            <p>Сіздің логиніңіз: { $data[name] }</p>";


            $msg .= "<p>Сіздің уақытша құпия сөзіңіз: {$password}</p>

            <p>Сілтеме арқылы сайтқа өтіңіз: https://zhanbolat.academy </p>


           <p> P.S. Егер бұл хатты түсініспеушілік нәтижесінде алған болсаңыз, хатты өшіре салыңыз.
            P.S. Zhanbolat Academy ұжымы, Сізге сапалы білім беруге, бар күшін салады.</p>

            <p>Біздің девиз: Our rewards will always be in exact proportion to our service
            Біздің миссиямыз: Әр адамның потенциалын ашу, Ол біздің ең басты миссиямыз.</p>

            <p>Телефон: 8 (708) 421-66-11
            Email: support@zhanbolat.academy
            Сайт: https://zhanbolat.academy  </p>

            <p>:copyright: Zhanbolat Academy 2020</p>";
        $this->sendEmail($data['email'],$msg,'Zhanbolat Academy');
        return $user;
    }
}

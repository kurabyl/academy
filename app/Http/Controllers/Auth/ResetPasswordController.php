<?php

namespace App\Http\Controllers\Auth;

use App\Entity\User\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Traits\EmailCommand;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;
    use EmailCommand;
    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';


    public function show()
    {
        return view('auth.passwords.reset');
    }

    public function reset(Request $request)
    {
        $password = $this->generatePassword();

        $msg = "
            <p>Сәлеметсізбе {$request->email}</p>
            <p>Сіздің құпиясөзіңіз : <strong>{$password }</strong></p>
        ";
        $send = $this->sendEmail($request->email,$msg,'Құпиясөз');
        if($send)
        {
            User::where('email',$request->email)->update([
                'password'=> Hash::make($password)
            ]);
            return redirect('/login')->with('success','Сіздің поштаңызға жаңа құпиясөз жіберілді');
        }
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Entity\User\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Traits\EmailCommand;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        if ($request->session()->get('tokenEmail')) {
            $request->session()->put('resetPassword','1');
            sleep(5);
            return redirect()->back();
        }
        $request->validate([
            'email'=>'required'
        ]);
        $password = $this->generatePassword();

        $msg = "

            <p>Сәлем {$request->email},</p>

            <p>Сіз, Zhanbolat Academy платформасыда құпия сөзді өзгертуге сұраныс жасадыңыз.</p>

            <p>Сіздің уақытша құпия сөзіңіз:<strong>$password</strong></p>
            <p>Сілтеме арқылы сайтқа өтіңіз: https://zhanbolat.academy </p>

            <p>Бұл хабарлама Сізге робот арқылы жіберілді және оған жауап беру қажет емес!
            P.S. Егер бұл хатты түсініспеушілік нәтижесінде алған болсаңыз, хатты өшіре салыңыз.</p><p>Телефон: 8 (708) 421-66-11</p>
            <p>Email: support@zhanbolat.academy</p>
            <p>Сайт: https://zhanbolat.academy  </p>

            <p>&copy;  Zhanbolat Academy 2020</p>


        ";
        $send = $this->sendEmail($request->email,$msg,'Құпиясөз');
        request()->session()->put('forget', md5('forget'));
        if($send)
        {
            $request->session()->put('tokenEmail',md5('asd'));

            User::where('email',$request->email)->update([
                'password'=> Hash::make($password)
            ]);
            return redirect('/login')->with('success','Сіздің поштаңызға жаңа құпиясөз жіберілді');
        }
    }
}

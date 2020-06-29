<!DOCTYPE html>
<html lang="en">
<head>
    <title>Zhanbolat Inc. | New Economy Business Academy</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login_assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login_assets/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login_assets/css/main.css?cache='.time()) }}">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="{{asset('login_assets/images/img-01.png')}}" alt="IMG">
            </div>
            @if(Session::get('forget') == md5('forget'))
                    <script>alert('Сәлем сіздің поштаңызға құпиясөз жіберілді')</script>
                <?php
                request()->session()->forget('forget');
                ?>
            @endif

            <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                @csrf
                <span class="login100-form-title">
						Zhanbolat Academy
					</span>
                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100 @error('email') is-invalid @enderror" type="text" name="email" placeholder="Email" style="font-family: Verdana;">

                    <span class="focus-input100"></span>

                    <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>

                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <div class="wrap-input100 validate-input" data-validate = "Password is required">
                    <input class="input100 @error('password') is-invalid @enderror" type="password" name="password" placeholder="Құпиясөз" style="font-family: Verdana;">

                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>

                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">
                        Кіру
                    </button>
                </div>

                <div class="text-center p-t-12">

                    <a class="txt2" href="{{url('/reset')}}" style="font-family: Verdana;">
                        Құпиясөзді ұмыттыңызба ?
                    </a>
                </div>

                <div class="text-center p-t-136">
                    <a class="txt2" href="{{ url('register') }}" style="font-family: Verdana;font-size: 17px;">
                        Тіркелу
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>




<!--===============================================================================================-->
<script
    src="https://code.jquery.com/jquery-3.2.1.js"
    integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
    crossorigin="anonymous"></script>
<!--===============================================================================================-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.4.0/umd/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/tilt/tilt.jquery.min.js"></script>
<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<!--===============================================================================================-->
<script src="{{asset('login_assets/js/main.js')}}"></script>

</body>
</html>

@extends('layouts.app')

@section('content')
<style>
	.modalDialog {
        position: fixed;
        font-family: Arial, Helvetica, sans-serif;
        top: -10%;
        right: 0;
        bottom: 0;
        left: 0;
        background: rgba(0,0,0,0.8);
        z-index: 99999;
        -webkit-transition: opacity 400ms ease-in;
        -moz-transition: opacity 400ms ease-in;
        transition: opacity 400ms ease-in;
        display: none;
        pointer-events: none;
        overflow: scroll;
    }

    .modalDialog:target {
        display: block;
        pointer-events: auto;
    }

    .modalDialog > div {
        width: 700px;
        position: relative;
        margin: 10% auto;
        padding: 5px 20px 13px 20px;
        border-radius: 10px;
        background: #fff;


    }

    .close {
        background: #606061;
        color: #FFFFFF;
        line-height: 25px;
        position: absolute;
        right: -12px;
        text-align: center;
        top: -10px;
        width: 24px;
        text-decoration: none;
        font-weight: bold;
        -webkit-border-radius: 12px;
        -moz-border-radius: 12px;
        border-radius: 12px;
        -moz-box-shadow: 1px 1px 3px #000;
        -webkit-box-shadow: 1px 1px 3px #000;
        box-shadow: 1px 1px 3px #000;
    }

    .close:hover { background: #00d9ff; }
    @media only screen and (max-width: 600px) {
        .modalDialog {
            top: 5%;
        }
        .modalDialog h2 {
            font-size:16px;
        }
        .modalDialog > div {
        width: 400px;
        position: relative;
        margin: 10% auto;
        padding: 5px 20px 13px 20px;
        border-radius: 10px;
        background: #fff;


    }
    }
    @media only screen and (max-width: 400px) {
        .modalDialog > div {
        width: 300px;
        position: relative;
        margin: 10% auto;
        padding: 5px 20px 13px 20px;
        border-radius: 10px;
        background: #fff;


    }
    .modalDialog {
            top: 5%;
        }
    .modalDialog h2 {
        font-size:16px;
    }
    }
	</style>
    <div class="content">

        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">

                    @if(Session::get('register') == md5('register'))
                        <div class="alert alert-success alert-block">

                            <button type="button" class="close" data-dismiss="alert">×</button>

                            <strong>Сәлем сіздің поштаңызға құпиясөз жіберілді</strong>

                        </div>
                        <?php
                        request()->session()->forget('register');
                        ?>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <h4>Қош келдіңіз</h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-body">
                                    <!-- <canvas id="TrafficChart"></canvas>   -->
                                    <div id="player" data-plyr-provider="youtube" data-plyr-embed-id="kRq6nw-FFJ0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
        </div>
    </div>
    <div id="openModal" class="modalDialog" style="
        @if(is_null($user->details['gender']) or is_null($user->details['phone']) or is_null($user->details['birthday'])) display: block;pointer-events: auto; @endif
    ">
	<div>
		
        <h2>Өзім туралы мәлімет</h2>
        <div class="row">
        <div class="col-lg-3">
        <form action="{{ route('change_details') }}" method="post">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Аты-жөні</label>
                                                                    <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                                                                </div>


                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Телефоні нөмері</label>
                                                                    <input type="text" class="form-control" name="phone" value="{{ $user->details['phone'] }}" id="phone"
                                                                    @if($user->details['phone'] != null)
                                                                        disabled
                                                                    @endif
                                                                    >
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleFormControlSelect1">Жынысы</label>
                                                                    <select name="gender" class="form-control" id="exampleFormControlSelect1">
                                                                        <option value="Ер" @if($user->details['gender']  == 'Ер') selected @endif>Ер</option>
                                                                        <option value="Әйел" @if($user->details['gender']  == 'Әйел') selected @endif>Әйел</option>

                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Туылған күні</label>
                                                                    <input type="date" class="form-control" name="date" value="{{ $user->details['birthday'] }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Telegram</label>
                                                                    <input type="text" class="form-control" name="telegram" value="{{ $user->details['telegram']}}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Instagram</label>
                                                                    <input type="text" class="form-control" name="instagram" value="{{ $user->details['instagram']}}">
                                                                </div>

                                                                
                                                                <button type="submit" class="btn btn-primary">Сақтау</button>
                                                            </form>
        </div>
        </div>
		</div>
</div>
@endsection
@section('js')
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

    <script>
        jQuery(function($){
            $('#phone').mask('+7 (999) 999-99-99', {placeholder: '+7 (777) 000-00-00'});
        })
    </script>
@stop
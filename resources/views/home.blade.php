@extends('layouts.app')

@section('content')

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
@endsection

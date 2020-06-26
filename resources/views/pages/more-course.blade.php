@extends('layouts.app')

@section('content')

    <style>

        .pb-cmnt-textarea {
            resize: none;
            padding: 20px;
            height: 130px;
            width: 100%;
            border: 4px solid #F2F2F2;
            margin-bottom: 10px;
        }
    </style>
    <div class="content">
        @include('messages')
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>{{ $more->title }}</h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-body">
                                    <!-- <canvas id="TrafficChart"></canvas>   -->
                                    <div id="player" data-plyr-provider="youtube" data-plyr-embed-id="{{ $more->video }}"></div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card-body">
                                    <!-- <canvas id="TrafficChart"></canvas>   -->
                                    {!! ($more->description) !!}
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <div class="card-body">
                                    <h3>Пікірлер</h3>
                                    <div class="mt-3"></div>
                                    <a href="#comments" class="btn btn-primary">Пікір қалдыру</a>
                                    <div class="mb-3"></div>
                                    <div class="card">
                                        @if($comment->count() > 0)
                                            @foreach($comment as $item)
                                        <div class="card-body">

                                                <h5 class="card-title">{{ $item->user['name'] }}</h5>
                                                <p class="card-text">{{ $item->text }}</p>
                                               <!--<a href="#" style="text-decoration: underline">Жауап беру</a>--->
                                                @if($item->answer->count() > 0)
                                                    @foreach($item->answer as $answer)
                                                        <div class="col-md-12 mt-2" style="border-top: 1px dashed #cccccc;">
                                                            <div class="card-body" >
                                                                <h5 class="card-title">{{ $answer->user['name'] }}</h5>
                                                                <p class="card-text">{{ $answer->text }}</p>
                                                                <!---<a href="#" style="text-decoration: underline">Жауап беру</a>--->
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif

                                        </div>
                                            @endforeach
                                        @endif
                                            <div class="mt-3"></div>
                                            <div class="col-md-12 col-md-offset-3" id="comments">
                                                <div class="panel panel-info">
                                                    <div class="panel-body">

                                                        <form class="form-inline" action="{{ url('student/add/comment') }}" method="post" onsubmit="">
                                                            @csrf
                                                            <input type="hidden" name="id_video" value=" {{ request()->id }}">
                                                            <textarea placeholder="Осы жерге пікіріңізді қалдырыңыз" name="comment" class="pb-cmnt-textarea"></textarea>
                                                            <input type="submit" value="Жіберу" class="btn btn-primary">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


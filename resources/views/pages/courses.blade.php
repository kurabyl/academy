@extends('layouts.app')
@section('roadmap')
    @include('pages.modal')
    <!-- Content -->
    @include('messages')

    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>{{$listCourse->title}}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="/">Басты бет</a></li>
                                <li>{{$listCourse->title}}</li>

                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                @foreach($listCourse->courses as $item)
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="{{ asset('image_course/'.$item->image) }}" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title mb-3">{{ $item->title }}</h4>
                                <p class="card-text"> {{ $item->description }} </p>
                                <a href="{{url('student/course/list/'.$item->id.'/?section='.$listCourse->title.'&sec_id='.$listCourse->id)}}" class="btn btn-primary">Толығырақ</a>

                                <a href="{{ url('student/section/'.request()->id.'/?course_id='.$item->id.'#buycourse') }}" class="btn btn-info"> Сатып аламын</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div><!-- .row -->
        </div>
    </div>


    <div id="buycourse" class="modalDialog">
        <div>
            <a href="#close" title="Закрыть" class="close">X</a>
            <p></p>
            <h4>Cұраныс</h4>
            <p></p>

            <p>Прмер простого модального окна, которое может быть создано с использованием CSS3.</p>
            @if(empty($user->details['phone']) || $user->details['phone'] == '')
                <p>Өтінеміз  телефон номеріңізді көрсетіңіз</p>
                <form action="{{ route('buy_course') }}" method="post" style="margin-bottom: 20px;">
                    @csrf
                    <input type="text" name="phone" id="phone">
                    <input type="hidden" name="course_id" value="{{ request()->course_id }}">
                    <input type="submit" value="Жіберу" >
                </form>
            @else
                <a href=" {{ url('student/buy/course/?course_id='.$item->id) }}" class="btn btn-info" disabled> Сұраныс жіберемін</a>

            @endif
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

    <script>
        jQuery(function($){
            $('#phone').mask('+7 (999) 999-99-99', {placeholder: '+7 (123) 456-78-90'});
        })
    </script>
@stop

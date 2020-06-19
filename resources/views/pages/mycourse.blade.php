@extends('layouts.app')
@section('roadmap')
    @include('pages.modal')
    <!-- Content -->
    @include('messages')

    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">

                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="brds text-right">
                                <li><a href="/">Басты бет</a></li>


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
                @foreach($listCourse as $item)
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="{{ asset('image_course/'.$item->image) }}" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title mb-3">{{ $item->title }}</h4>
                                <p class="card-text"> {{ $item->description }} </p>
                                <a href="{{url('student/course/list/'.$item->id)}}" class="btn btn-primary">Толығырақ</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div><!-- .row -->
        </div>
    </div>



@endsection

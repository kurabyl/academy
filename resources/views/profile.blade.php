@extends('layouts.app')

@section('content')
    @include('profielcss')
    @include('pages.modal')
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Менім аккаунтым</h4>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">

                                <div class="card-body">
                                    @include('messages')
                                    <div id="user-profile-2" class="user-profile">
                                        <div class="tabbable">
                                            <ul class="nav nav-tabs padding-18">
                                                <li class="active">
                                                    <a data-toggle="tab" href="#home">
                                                        <i class="green ace-icon fa fa-user bigger-120"></i>
                                                        Профиль
                                                    </a>
                                                </li>



                                                <li>
                                                    <a data-toggle="tab" href="#friends">
                                                        <i class="blue ace-icon fa fa-users bigger-120"></i>
                                                        Өзгерту
                                                    </a>
                                                </li>
                                            </ul>

                                            <div class="tab-content no-border padding-24">
                                                <div id="home" class="tab-pane in active">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-3 center">
							<span class="profile-picture">
								<img class="editable img-responsive" alt=" Avatar" id="avatar2" src="{{ asset('useravatar.jpg') }}">
							</span>

                                                            <div class="space space-4"></div>

                                                            <!---<a href="#uploadPhoto" class="btn btn-sm btn-block btn-success">
                                                                <i class="ace-icon fa fa-plus-circle bigger-120"></i>
                                                                <span class="bigger-110">Суретті өзгерту</span>
                                                            </a>---->
                                                        </div><!-- /.col -->

                                                        <div class="col-xs-12 col-sm-9">
                                                            <h4 class="blue">
                                                                <span class="middle">{{ $user->name }}</span>

                                                                <span class="label label-purple arrowed-in-right">
									<i class="ace-icon fa fa-circle smaller-80 align-middle"></i>
									online
								</span>
                                                            </h4>

                                                            <div class="profile-user-info">
                                                                <div class="profile-info-row">
                                                                    <div class="profile-info-name"> E-mail </div>

                                                                    <div class="profile-info-value">
                                                                        <span>{{ $user->email }}</span>
                                                                    </div>
                                                                </div>

                                                                <div class="profile-info-row">
                                                                    <div class="profile-info-name"> Жынысы </div>

                                                                    <div class="profile-info-value">

                                                                        <span>{{ $user->details['gender'] ?? 'көрсетілмеген' }}</span>

                                                                    </div>
                                                                </div>

                                                                <div class="profile-info-row">
                                                                    <div class="profile-info-name"> Туылған күні </div>

                                                                    <div class="profile-info-value">
                                                                        <span>{{ $user->details['birthday'] ?? 'көрсетілмеген' }}</span>
                                                                    </div>
                                                                </div>

                                                                <div class="profile-info-row">
                                                                    <div class="profile-info-name"> Тіркелген күні </div>

                                                                    <div class="profile-info-value">
                                                                        <span>{{ $user->created_at  }}</span>
                                                                    </div>
                                                                </div>

                                                                <div class="profile-info-row">
                                                                    <div class="profile-info-name"> Телеграм </div>

                                                                    <div class="profile-info-value">
                                                                        <span>{{ $user->details['telegram'] ?? 'көрсетілмеген' }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="hr hr-8 dotted"></div>

                                                            <div class="profile-user-info">
                                                                <div class="profile-info-row">
                                                                    <div class="profile-info-name"> Instagram </div>

                                                                    <div class="profile-info-value">
                                                                        {{ $user->details['instagram'] ?? 'көрсетілмеген' }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- /.col -->
                                                    </div><!-- /.row -->

                                                    <div class="space-20"></div>

                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-6">




                                                        </div>
                                                    </div>
                                                </div><!-- /#home -->



                                                <div id="friends" class="tab-pane">

                                                    <div class="row">
                                                        <div class="card-title"></div>
                                                        <div class="col-lg-6">
                                                            <form action="{{ route('change_details') }}" method="post">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Аты-жөні</label>
                                                                    <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                                                                </div>


                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Телефоні нөмері</label>
                                                                    <input type="text" class="form-control" name="phone" value="{{ $user->details['phone'] }}" id="phone"
                                                                    @if($user->details['phone'] != '')
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
                                                                    <input type="text" class="form-control" name="telegram" value="{{ $user->details['telegram'] }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Instagram</label>
                                                                    <input type="text" class="form-control" name="instagram" value="{{ $user->details['instagram'] }}">
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Сақтау</button>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div><!-- /#friends -->


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

    <div id="uploadPhoto1111" class="modalDialog">
        <div style="width: 500px;">
            <a href="#close" title="Закрыть" class="close">X</a>
            <p></p>
            <h4>Суретті өзгерту</h4>
            <p></p>
            <form action="{{ route('change_details') }}" method="post" style="margin-bottom: 20px;" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" id="phone" class="form-control">
                    <p></p>
                    <input type="submit" value="Өзгерту" class="btn btn-success">
            </form>
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

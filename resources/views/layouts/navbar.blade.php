 <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="/"><i class="menu-icon fa fa-laptop"></i>Басты бет </a>
                    </li>
                    <li class="menu-title">Курстар</li><!-- /.menu-title -->
                    @foreach(\App\UseCases\Section\SectionListService::get() as $list)

                    <li class="menu-item-has-children dropdown">
                        <a href="{{ url('student/section/'.$list->id) }}" class="dropdown-toggle"  aria-haspopup="true" aria-expanded="false">
                            <i class="menu-icon fa {{ $list->icon }}"></i>{{ $list->title }}</a>
                    </li>

                    @endforeach



                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>

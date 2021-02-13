<div class="sidebar-wrapper">
    <div class="user">
        <div class="photo">
            <img src="/img/faces/avatar.jpg" />
        </div>
        <div class="user-info">
            <a data-toggle="collapse" href="#collapseExample" class="username">
              <span>
                ADMIN
{{--                <b class="caret"></b>--}}
              </span>
            </a>
{{--            <div class="collapse" id="collapseExample">--}}
{{--                <ul class="nav">--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="#">--}}
{{--                            <span class="sidebar-mini"> MP </span>--}}
{{--                            <span class="sidebar-normal"> My Profile </span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="#">--}}
{{--                            <span class="sidebar-mini"> EP </span>--}}
{{--                            <span class="sidebar-normal"> Edit Profile </span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="#">--}}
{{--                            <span class="sidebar-mini"> S </span>--}}
{{--                            <span class="sidebar-normal"> Settings </span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
        </div>
    </div>
    <ul class="nav">
        <li class="nav-item {{ Request::is('/') ? 'active' : '' }} ">
            <a class="nav-link" href="/">
                <i class="material-icons">dashboard</i>
                <p> Главная </p>
            </a>
        </li>
        <li class="nav-item {{ Request::is('category*') ? 'active' : '' }}">
            <a class="nav-link" href="{{route('category.index')}}">
                <i class="material-icons">category</i>
                <p> Категории </p>
            </a>
        </li>
        <li class="nav-item {{ Request::is('tag*') ? 'active' : '' }}">
            <a class="nav-link" href="{{route('tag.index')}}">
                <i class="material-icons">tag</i>
                <p> Теги </p>
            </a>
        </li>
        <li class="nav-item {{ Request::is('new*') ? 'active' : '' }}">
            <a class="nav-link" href="{{route('new.index')}}">
                <i class="material-icons">fiber_new</i>
                <p> Посты </p>
            </a>
        </li>
        <li class="nav-item {{ Request::is('conference*') ? 'active' : '' }}">
            <a class="nav-link" href="{{route('conference.index')}}">
                <i class="material-icons">ondemand_video</i>
                <p> Конференции </p>
            </a>
        </li>
{{--        <li class="nav-item ">--}}
{{--            <a class="nav-link" data-toggle="collapse" href="#pagesExamples">--}}
{{--                <i class="material-icons">image</i>--}}
{{--                <p> Pages--}}
{{--                    <b class="caret"></b>--}}
{{--                </p>--}}
{{--            </a>--}}
{{--            <div class="collapse" id="pagesExamples">--}}
{{--                <ul class="nav">--}}
{{--                    <li class="nav-item ">--}}
{{--                        <a class="nav-link" href="../examples/pages/pricing.html">--}}
{{--                            <span class="sidebar-mini"> P </span>--}}
{{--                            <span class="sidebar-normal"> Pricing </span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item ">--}}
{{--                        <a class="nav-link" href="../examples/pages/rtl.html">--}}
{{--                            <span class="sidebar-mini"> RS </span>--}}
{{--                            <span class="sidebar-normal"> RTL Support </span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </li>--}}

        <li class="nav-item ">
            <a class="nav-link" href="/logout">
                <i class="material-icons">exit_to_app</i>
                <p> Выход </p>
            </a>
        </li>
    </ul>
</div>

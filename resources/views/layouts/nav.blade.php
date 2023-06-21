<nav class="navbar bg-body-tertiary fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">{{ $nav['webName'] }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">{{ $nav['navName'] }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">

                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ route($navDatas[0]['admin_nav_route']) }}">{{ $navDatas[0]['admin_nav_name'] }}</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            深層管理
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($navDatas as $key => $value)
                                @if ($value['admin_nav_route'] != 'index' && $value['admin_nav'] == 0)
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ !empty($value['admin_nav_route']) ? route($value['admin_nav_route']) : null }}">{{ $value['admin_nav_name'] }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            一般管理
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($navDatas as $key => $value)
                                @if ($value['admin_nav'] == 1)
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ !empty($value['admin_nav_route']) ? route($value['admin_nav_route']) : null }}">{{ $value['admin_nav_name'] }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                    
                </ul>
            </div>
        </div>
    </div>
</nav>
<div class="fixed-top text-center" style="margin-top:10vh">
    @foreach ($navDatas as $key => $value)
        <button class="btn btn-primary">
            <a class="nav-link"
                href="{{ !empty($value['admin_nav_route']) ? route($value['admin_nav_route']) : null }}">{{ $value['admin_nav_name'] }}</a>
        </button>
    @endforeach
</div>

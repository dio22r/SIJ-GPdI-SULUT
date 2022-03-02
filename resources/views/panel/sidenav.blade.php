<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                @foreach($sidemenu as $menu)

                @if($menu->type == 1)
                <div class="sb-sidenav-menu-heading">{{ $menu->name }}</div>
                @else
                <a class="nav-link @if (Request::is($menu->code)) active @endif" href="{{ url($menu->code) }}">
                    <div class="sb-nav-link-icon" style="width:20px">
                        <i class="{{ $menu->icon }}"></i>
                    </div>
                    {{ $menu->name }}
                </a>
                @endif

                @endforeach

            </div>
        </div>
    </nav>
</div>

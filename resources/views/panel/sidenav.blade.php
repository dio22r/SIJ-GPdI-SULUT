<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                @foreach($sidemenu as $menu)

                @if($menu->type == 1)
                <div class="sb-sidenav-menu-heading">{{ $menu->name }}</div>
                @elseif($menu->type == 2)
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="{{ $menu->icon }}"></i></div>
                    {{ $menu->name }}
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        @foreach($menu->Children as $menuChildren)
                        <a class="nav-link @if (Request::is('admin/' . $menu->code . '*')) active @endif" href="{{ url('admin/' . $menu->code) }}">
                            <div class="sb-nav-link-icon" style="width:20px">
                                <i class="{{ $menuChildren->icon }}"></i>
                            </div>
                            {{ $menuChildren->name }}
                        </a>
                        @endforeach
                    </nav>
                </div>
                @else
                <a class="nav-link @if (Request::is('admin/' . $menu->code . '*')) active @endif" href="{{ url('admin/' . $menu->code) }}">
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

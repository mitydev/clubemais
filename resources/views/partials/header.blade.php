<nav class="app-header navbar navbar-expand bg-body">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block"><a href="/" class="nav-link">Home</a></li>
        </ul>
        <!--end::Start Navbar Links-->
        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">
            <!--begin::Navbar Search-->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="bi bi-search"></i>
                </a>
            </li>
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img
                        src="{{asset('assets/img/user2-160x160.jpg')}}"
                        class="user-image rounded-circle shadow"
                        alt="User Image"
                    />
                    <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <!--begin::User Image-->
                    <li class="user-header text-bg-primary">
                        <img
                            src="{{asset('assets/img/user2-160x160.jpg')}}"
                            class="rounded-circle shadow"
                            alt="User Image"
                        />
                        <p>
                            {{ auth()->user()->name }}
                            <small>Member since Nov. 2023</small>
                        </p>
                    </li>
                    <!--end::User Image-->
                    <!--begin::Menu Body-->
                    <li class="user-body">
                        <!--begin::Row-->
                        <div class="row">
                            <div class="col-4 text-center"><a href="#">Followers</a></div>
                            <div class="col-4 text-center"><a href="#">Sales</a></div>
                            <div class="col-4 text-center"><a href="#">Friends</a></div>
                        </div>
                        <!--end::Row-->
                    </li>
                    <!--end::Menu Body-->
                    <!--begin::Menu Footer-->
                    <li class="user-footer">
                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                        <a href="#" class="btn btn-default btn-flat float-end">Sign out</a>
                    </li>
                    <!--end::Menu Footer-->
                </ul>
            </li>
            <!--end::User Menu Dropdown-->
        </ul>
        <!--end::End Navbar Links-->
    </div>
    <!--end::Container-->
</nav>
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            <img
                src="{{ @asset('images/logo.svg') }}"
                alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow"
            />
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
            class="nav sidebar-menu flex-column"
            data-lte-toggle="treeview"
            role="navigation"
            aria-label="Main navigation"
            data-accordion="false"
            id="navigation"
            >
            {{-- Painel --}}
            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                @if(request()->routeIs('dashboard')) aria-current="page" @endif>
                <i class="nav-icon bi bi-speedometer"></i>
                <p>Painel</p>
                </a>
            </li>

            {{-- Páginas (submenu) --}}
            @php
                $isPages = request()->routeIs('pages.*') || request()->routeIs('pages.sections.*');
            @endphp
            <li class="nav-item {{ $isPages ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ $isPages ? 'active' : '' }}">
                <i class="nav-icon bi bi-pen"></i>
                <p>Páginas <i class="nav-arrow bi bi-chevron-right"></i></p>
                </a>
                <ul class="nav nav-treeview small ps-3 ms-2 my-1 border-start border-1 border-secondary-subtle rounded-1">
                <li class="nav-item">
                    <a href="{{ route('pages.index') }}"
                    class="nav-link {{ request()->routeIs('pages.index') ? 'active' : '' }}"
                    @if(request()->routeIs('pages.index')) aria-current="page" @endif>
                    <i class="nav-icon bi bi-list"></i>
                    <p>Lista</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('pages.create') }}"
                    class="nav-link {{ request()->routeIs('pages.create') ? 'active' : '' }}"
                    @if(request()->routeIs('pages.create')) aria-current="page" @endif>
                    <i class="nav-icon bi bi-plus-circle"></i>
                    <p>Novo</p>
                    </a>
                </li>

                {{-- Mantém ativo quando estiver editando a página ou gerenciando seções dela --}}
                <li class="nav-item">
                    <a href="{{ route('pages.index') }}"
                    class="nav-link {{ request()->routeIs(['pages.edit','pages.sections.*']) ? 'active' : '' }}"
                    @if(request()->routeIs(['pages.edit','pages.sections.*'])) aria-current="page" @endif>
                    <i class="nav-icon bi bi-grid"></i>
                    <p>Seções (por página)</p>
                    </a>
                </li>
                </ul>
            </li>

            {{-- Banners (submenu) --}}
            @php
                $isBanners = request()->routeIs('banners.*') || request()->routeIs(['banners.groups','banners.groups.*']);
            @endphp
            <li class="nav-item {{ $isBanners ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ $isBanners ? 'active' : '' }}">
                <i class="nav-icon bi bi-image"></i>
                <p>Banners <i class="nav-arrow bi bi-chevron-right"></i></p>
                </a>
                <ul class="nav nav-treeview small ps-3 ms-2 my-1 border-start border-1 border-secondary-subtle rounded-1">
                <li class="nav-item">
                    <a href="{{ route('banners.index') }}"
                    class="nav-link {{ request()->routeIs(['banners.index','banners.edit']) ? 'active' : '' }}"
                    @if(request()->routeIs(['banners.index','banners.edit'])) aria-current="page" @endif>
                    <i class="nav-icon bi bi-list"></i>
                    <p>Lista</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('banners.groups') }}"
                    class="nav-link {{ request()->routeIs(['banners.groups','banners.groups.*']) ? 'active' : '' }}"
                    @if(request()->routeIs(['banners.groups','banners.groups.*'])) aria-current="page" @endif>
                    <i class="nav-icon bi bi-collection"></i>
                    <p>Por grupo</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('banners.create') }}"
                    class="nav-link {{ request()->routeIs('banners.create') ? 'active' : '' }}"
                    @if(request()->routeIs('banners.create')) aria-current="page" @endif>
                    <i class="nav-icon bi bi-plus-circle"></i>
                    <p>Novo</p>
                    </a>
                </li>
                </ul>
            </li>

            {{-- Destinos (submenu) --}}
            @php
                $isDestinos = request()->routeIs('destinos.*') || request()->routeIs(['destinos.groups','destinos.groups.*']);
            @endphp
            <li class="nav-item {{ $isDestinos ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ $isDestinos ? 'active' : '' }}">
                <i class="nav-icon bi bi-geo-alt-fill"></i>
                <p>Destinos <i class="nav-arrow bi bi-chevron-right"></i></p>
                </a>
                <ul class="nav nav-treeview small ps-3 ms-2 my-1 border-start border-1 border-secondary-subtle rounded-1">
                <li class="nav-item">
                    <a href="{{ route('destinos.index') }}"
                    class="nav-link {{ request()->routeIs(['destinos.index','destinos.edit']) ? 'active' : '' }}"
                    @if(request()->routeIs(['destinos.index','destinos.edit'])) aria-current="page" @endif>
                    <i class="nav-icon bi bi-list"></i>
                    <p>Lista</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('destinos.groups') }}"
                    class="nav-link {{ request()->routeIs(['destinos.groups','destinos.groups.*']) ? 'active' : '' }}"
                    @if(request()->routeIs(['destinos.groups','destinos.groups.*'])) aria-current="page" @endif>
                    <i class="nav-icon bi bi-collection"></i>
                    <p>Por grupo</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('destinos.create') }}"
                    class="nav-link {{ request()->routeIs('destinos.create') ? 'active' : '' }}"
                    @if(request()->routeIs('destinos.create')) aria-current="page" @endif>
                    <i class="nav-icon bi bi-plus-circle"></i>
                    <p>Novo</p>
                    </a>
                </li>
                </ul>
            </li>

            {{-- Configurações (submenu) – Footer --}}
            @php
                // abre "Configurações" em Footer **e** Navbar
                $isSettings = request()->routeIs(
                    'admin.footer.*',
                    'admin.navbar.*',
                    'settings.*',   // se ainda fizer sentido manter
                );
            @endphp
            <li class="nav-item {{ $isSettings ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ $isSettings ? 'active' : '' }}">
                <i class="nav-icon bi bi-gear"></i>
                <p>Configurações <i class="nav-arrow bi bi-chevron-right"></i></p>
                </a>
                <ul class="nav nav-treeview small ps-3 ms-2 my-1 border-start border-1 border-secondary-subtle rounded-1">
                    <li class="nav-item">
                        <a href="{{ route('admin.navbar.edit') }}"
                        class="nav-link {{ request()->routeIs('admin.navbar.*') ? 'active' : '' }}"
                        @if(request()->routeIs('admin.navbar.*')) aria-current="page" @endif>
                            <i class="nav-icon bi bi-menu-button-wide"></i>
                            <p>Navbar</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.footer.edit') }}"
                        class="nav-link {{ request()->routeIs('admin.footer.*') ? 'active' : '' }}"
                        @if(request()->routeIs('admin.footer.*')) aria-current="page" @endif>
                            <i class="nav-icon bi bi-ui-checks-grid"></i>
                            <p>Footer</p>
                        </a>
                    </li>
                </ul>
            </li>

            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>


    <!--end::Sidebar Wrapper-->
</aside>

<div class="sidebar-brand">
    <!--begin::Brand Link-->
    <a href="/dashboard" class="brand-link">
        <!--begin::Brand Image-->
        <img
            src="{{ @asset('images/logo.svg') }}"
            alt="AdminLTE Logo"
            class="brand-image opacity-75 shadow"
        />
    </a>
    <!--end::Brand Link-->
</div>

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
            // ajuste os patterns conforme o prefixo usado nas rotas do admin:
            $isSettings = request()->routeIs('admin.footer.*') || request()->routeIs('settings.*');
        @endphp
        <li class="nav-item {{ $isSettings ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ $isSettings ? 'active' : '' }}">
            <i class="nav-icon bi bi-gear"></i>
            <p>Configurações <i class="nav-arrow bi bi-chevron-right"></i></p>
            </a>
            <ul class="nav nav-treeview small ps-3 ms-2 my-1 border-start border-1 border-secondary-subtle rounded-1">
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
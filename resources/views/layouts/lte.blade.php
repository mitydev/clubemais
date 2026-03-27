<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Clube Mais - Dashboard</title>
  <link rel="icon" type="image/png" href="{{ asset('images/plus.png') }}">

  {{-- Fonts / CSS de terceiros --}}
  <link rel="preload" href="{{ asset('css/adminlte.css') }}" as="style" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous"
        media="print" onload="this.media='all'"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

  {{-- AdminLTE CSS --}}
  <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}"/>

  <style>
    /* refinamentos do submenu da sidebar */
    .sidebar-menu .nav-treeview{ --submenu-indent:1.25rem; position:relative; margin-left:.25rem; }
    .sidebar-menu .nav-treeview::before{ content:""; position:absolute; left:.25rem; top:.25rem; bottom:.25rem;
      border-left:1px dashed var(--bs-border-color); opacity:.6; }
    .sidebar-menu .nav-treeview > .nav-item > .nav-link{ padding-left:calc(1rem + var(--submenu-indent)); border-radius:.375rem; }
    .sidebar-menu .nav-treeview > .nav-item > .nav-link .nav-icon{ font-size:.9rem; margin-right:.35rem; opacity:.85; }
    .sidebar-menu .nav-item.menu-open > .nav-link{ background-color:var(--bs-gray-200); }
    .sidebar-menu .nav-treeview > .nav-item > .nav-link.active{ background-color:var(--bs-primary-bg-subtle); color:var(--bs-primary); }
  </style>
</head>

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
<div class="app-wrapper">

  {{-- Navbar/Header do topo --}}
  @include('partials.header')

  {{-- Sidebar fixa (precisa do wrapper) --}}
  <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-wrapper">
      @include('partials.sidebar')
    </div>
  </aside>

  {{-- Conteúdo principal --}}
  <main class="app-main">
    {{-- Cabeçalho da página opcional (breadcrumbs) --}}
    <div class="app-content-header">
      <div class="container-fluid">
        {{-- Você pode colocar breadcrumbs aqui, se quiser --}}
      </div>
    </div>

    {{-- Área de conteúdo --}}
    <div class="app-content">
      <div class="container-fluid">
        @yield('content')
      </div>
    </div>
  </main>

  {{-- Rodapé do AdminLTE (não o footer do site público) --}}
  @include('partials.footer')

</div>

{{-- JS de terceiros --}}
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>

{{-- AdminLTE JS --}}
<script src="{{ asset('js/adminlte.js') }}"></script>

{{-- Inicialização do OverlayScrollbars na sidebar --}}
<script>
  const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
  document.addEventListener('DOMContentLoaded', function () {
    const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
    if (sidebarWrapper && window.OverlayScrollbarsGlobal?.OverlayScrollbars) {
      OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
        scrollbars: { theme: 'os-theme-light', autoHide: 'leave', clickScroll: true }
      });
    }
  });
</script>

{{-- Ponto de injeção de scripts das páginas (ex.: settings/footer) --}}
@stack('lte-scripts')
</body>
</html>

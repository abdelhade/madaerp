<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
@include('admin.partials.head')

<body class="daily-progress-layout">
    {{-- YouTube-style Progress Bar Loader --}}
    <div id="page-loader" class="page-loader">
        <div class="loader-bar"></div>
    </div>
    
    {{-- Dynamic Sidebar --}}
    @hasSection('sidebar')
        <div class="left-sidenav">
            <div class="menu-content h-100" data-simplebar>
                <ul class="metismenu left-sidenav-menu">
                    <li class="nav-item border-bottom pb-1 mb-2">
                        <a href="{{ route('admin.dashboard') }}"
                            class="nav-link d-flex align-items-center gap-2 transition-base"
                            style="color: var(--color-text-secondary);">
                            <i data-feather="home" style="color: #6b7280" class="menu-icon"></i>
                            {{ __('navigation.home') }}
                        </a>
                    </li>
                    @yield('sidebar')
                </ul>
            </div>
        </div>
    @else
        @include('admin.partials.sidebar-default')
    @endif

    <div class="page-wrapper">
        @include('admin.partials.topbar')
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    @include('sweetalert::alert')
                    @yield('content')
                </div>
            </div>
            @include('admin.partials.footer')
        </div>
    </div>
    @include('admin.partials.scripts')
    @yield('script')
</body>
</html>

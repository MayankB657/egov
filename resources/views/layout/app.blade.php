<!DOCTYPE html>
<html lang="en">
@include('components.head')

<body id="kt_body" class="header-tablet-and-mobile-fixed aside-enabled {{ $user->language == 'mr' ? 'mr' : 'en' }}">
    <div id="preloader"></div>
    <audio id="NotificationSound">
        <source src="{{ url('/') }}/public/images/notification.mp3" type="audio/mp3">
    </audio>
    <div class="d-flex flex-column flex-root">
        @include('alert')
        <div class="page d-flex flex-row flex-column-fluid">
            @include('components.sidebar')
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                @include('components.header')
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    @yield('content')
                </div>
                @include('components.footer')
            </div>
        </div>
    </div>
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </div>
    @include('components.script')
</body>

</html>

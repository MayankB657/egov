<x-guest-layout>
    @section('content')
        <div class="d-flex flex-column justify-content-center align-items-center flex-grow-1 flex-lg-row">
            <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
                <div class="d-flex flex-center flex-lg-start flex-column">
                    <img src="{{ url('/') }}/public/images/logo.svg" class="w-100" />
                </div>
            </div>
            <div class="d-flex flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
                <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
                    <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-10">
                        <form class="form w-100" id="FormId" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="text-center mb-11">
                                <h1 class="text-gray-900 fw-bolder mb-3">Sign In</h1>
                                <div class="text-gray-500 fw-semibold fs-6">Your Social Campaigns</div>
                            </div>
                            <div class="fv-row mb-8">
                                <input type="text" placeholder="Email" name="email" class="form-control bg-transparent"
                                    value="mayu.bhandure657@gmail.com" />
                            </div>
                            <div class="position-relative mb-3">
                                <input class="form-control bg-transparent" type="password" name="password"
                                    placeholder="Password" value="12345"/>
                                <span
                                    class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2 showPassword">
                                    <i class="mb mb-eye-close text-muted fs-1"></i>
                                </span>
                            </div>
                            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                <div></div>
                                <a href="{{ route('password.request') }}" class="link-primary">Forgot Password ?</a>
                            </div>
                            <div class="d-grid mb-10">
                                <button type="submit" class="btn btn-primary">Sign In</button>
                            </div>
                        </form>
                    </div>
                    <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 ms-auto">
                        <a href="#" class="btn btn-sm btn-icon btn-icon-muted btn-active-icon-primary"
                            data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent"
                            data-kt-menu-placement="top-end">
                            <i class="bi bi-sun-fill theme-light-show fs-4"></i>
                            <i class="bi bi-moon-fill theme-dark-show fs-4"></i>
                            <label class="ms-2 fs-4 text-gray-900 theme-light-show">Light</label>
                            <label class="ms-2 fs-4 text-gray-900 theme-dark-show">Dark</label>
                        </a>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                            data-kt-menu="true" data-kt-element="theme-mode-menu">
                            <div class="menu-item px-3 my-0">
                                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                                    <span class="menu-icon" data-kt-element="icon">
                                        <i class="bi bi-sun-fill fs-2"></i>
                                    </span>
                                    <span class="menu-title">Light</span>
                                </a>
                            </div>
                            <div class="menu-item px-3 my-0">
                                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                                    <span class="menu-icon" data-kt-element="icon">
                                        <i class="bi bi-moon-fill fs-2"></i>
                                    </span>
                                    <span class="menu-title">Dark</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-guest-layout>

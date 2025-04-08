<div class="page-loader flex-column bg-dark bg-opacity-25">
    <span class="spinner-border text-primary" role="status"></span>
    <span class="text-gray-800 fs-6 fw-semibold mt-5">Loading...</span>
</div>
<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
        <div class="text-gray-900 order-2 order-md-1">
            <span class="text-muted fw-semibold me-1">{{ Carbon::now()->format('Y') }} © All rights reserved </span>
            <a class="text-gray-800 text-hover-primary">{{ config('app.name') }}</a>
        </div>
        <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
            <li>
                <span id="LiveDate"></span>&nbsp;<span id="LiveTime"></span>
            </li>
        </ul>
    </div>
</div>

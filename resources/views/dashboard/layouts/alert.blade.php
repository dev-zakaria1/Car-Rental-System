@if (session('success'))
    <div class="position-fixed top-1 start-50 translate-middle-x p-8 animate-alert fade-out-element"
        style="z-index: 9999; width: 100%; max-width: 400px;">

        <div class="d-flex align-items-center justify-content-center bg-success text-white shadow-lg rounded"
            style="height: 80px;">
            <div class="d-flex align-items-center p-3">
                <i class="me-3" data-feather="check-circle" style="width: 24px; height: 24px;"></i>
                <div class="alert-message text-center">
                    <strong class="d-block">Success!</strong>
                    <span class="small">{{ session('success') }}</span>
                </div>
            </div>

            <button type="button" class="btn-close btn-close-white position-absolute end-0 top-0 m-2"
                data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>

    </div>
@endif

@if (session('error'))
    <div class="position-fixed top-1 start-50 translate-middle-x p-8 animate-alert fade-out-element "
        style="z-index: 9999; width: 100%; max-width: 400px;">

        <div class="d-flex align-items-center justify-content-center bg-danger text-white shadow-lg rounded"
            style="height: 80px;">
            <div class="d-flex align-items-center p-3">
                <i class="me-3" data-feather="alert-circle" style="width: 24px; height: 24px;"></i>
                <div class="alert-message text-center">
                    <strong class="d-block">Error!</strong>
                    <span class="small">{{ session('error') }}</span>
                </div>
            </div>

            <button type="button" class="btn-close btn-close-white position-absolute end-0 top-0 m-2"
                data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    </div>
@endif

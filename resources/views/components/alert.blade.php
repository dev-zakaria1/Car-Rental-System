@if (session('success'))
    <div class="position-fixed top-0 start-0 w-100 d-flex justify-content-center p-3" style="z-index: 9999;">
        <div class="animate-alert fade-out-element shadow-lg rounded bg-success text-white"
            style="width: 100%; max-width: 400px; height: 80px; position: relative;">

            <div class="d-flex align-items-center h-100 p-3">
                <i class="me-3" data-feather="check-circle" style="width: 24px; height: 24px;"></i>
                <div class="text-center w-100">
                    <strong class="d-block">!Success</strong>
                    <span class="small">{{ session('success') }}</span>
                </div>
            </div>
            <button type="button"
                class="btn-close position-absolute border-0 d-flex align-items-center justify-content-center"
                data-bs-dismiss="alert" aria-label="Close"
                style="top: 10px; right: 10px; width: 28px;height: 28px; background-color: #28a745; color: #000; border-radius: 4px; z-index: 10;cursor: pointer;font-size: 30px;line-height: 0.8; padding-bottom: 4px;outline: none !important;box-shadow: none !important;">
                <span aria-hidden="true" style="margin-top: -2px;">&times;</span>
            </button>
        </div>
    </div>
@endif
@if (session('error'))
    <div class="position-fixed top-0 start-0 w-100 d-flex justify-content-center p-3" style="z-index: 9999;">
        <div class="animate-alert fade-out-element shadow-lg rounded bg-danger text-white"
            style="width: 100%; max-width: 400px; height: 80px; position: relative;">

            <div class="d-flex align-items-center h-100 p-3">
                <i class="me-3" data-feather="check-circle" style="width: 24px; height: 24px;"></i>
                <div class="text-center w-100">
                    <strong class="d-block">!Error</strong>
                    <span class="small">{{ session('error') }}</span>
                </div>
            </div>

            <button type="button"
                class="btn-close position-absolute border-0 d-flex align-items-center justify-content-center"
                data-bs-dismiss="alert" aria-label="Close"
                style="top: 10px; right: 10px; width: 28px;height: 28px; background-color: #28a745; color: #000; border-radius: 4px; z-index: 10;cursor: pointer;font-size: 30px;line-height: 0.8; padding-bottom: 4px;outline: none !important;box-shadow: none !important;">
                <span aria-hidden="true" style="margin-top: -2px;">&times;</span>
            </button>
        </div>
    </div>
@endif

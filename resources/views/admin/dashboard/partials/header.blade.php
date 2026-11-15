<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-5">

    <div>
        <div class="d-flex align-items-center gap-2 mb-2">
            <span class="text-danger fw-bold small">CITYPULSE</span>
            <span class="cc-muted small">/</span>
            <span class="cc-muted small">OPERATIONS</span>
        </div>

        <h1 class="fw-bold mb-1" style="letter-spacing:-1px;">
            Command Centre
        </h1>

        <p class="cc-muted mb-0">
            Citywide monitoring and operational intelligence.
        </p>
    </div>

    <div class="d-flex align-items-center gap-3 flex-wrap">

        <div class="cc-live">
            <span class="cc-live-dot"></span>
            SYSTEM OPERATIONAL
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-outline-danger cc-btn">
                Logout
            </button>
        </form>

    </div>

</div>

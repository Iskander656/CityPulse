<header class="admin-header d-flex justify-content-between align-items-center flex-wrap gap-4 mb-5">
    <div class="admin-header__identity">
        <div class="admin-header__eyebrow d-flex align-items-center gap-2 mb-2">
            <span class="admin-header__brand">CITYPULSE</span>
            <span class="admin-header__separator">/</span>
            <span class="admin-header__section">OPERATIONS</span>
        </div>

        <h1 class="admin-header__title mb-2">
            Command Centre
        </h1>

        <p class="admin-header__subtitle mb-0">
            Citywide monitoring and operational intelligence.
        </p>
    </div>

    <div class="admin-header__actions d-flex align-items-center gap-3 flex-wrap">
        <div class="admin-header__system-status" role="status" aria-label="System operational">
            <span class="admin-header__status-dot"></span>
            <span>SYSTEM OPERATIONAL</span>
        </div>

        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="admin-header__logout">
                <span>Logout</span>
                <i class="bi bi-box-arrow-right" aria-hidden="true"></i>
            </button>
        </form>
    </div>
</header>

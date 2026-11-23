<header class="officer-dashboard-header">
    <div class="officer-header-copy">
        <div class="officer-eyebrow"><span class="officer-eyebrow-dot"></span> CITYPULSE / DEPARTMENT
            OPERATIONS
        </div>
        <h1>Officer Command Center</h1>
        <p>Welcome back, {{ auth()->user()->name }}. Here's your department's latest activity and report
            overview.</p>
    </div>

    <div class="officer-header-actions">
        <div class="officer-workspace-status"><span></span> Department workspace</div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="officer-logout-button">Log out <span aria-hidden="true">↗</span></button>
        </form>
    </div>
</header>

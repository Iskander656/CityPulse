<footer class="citizen-dashboard-footer">
    <span>YOUR CITY. YOUR VOICE. YOUR IMPACT.</span>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="citizen-dashboard-logout">Sign out <span aria-hidden="true">↗</span></button>
    </form>
</footer>

<nav class="navbar navbar-expand-lg city-navbar">
        <div class="container">

            <a class="navbar-brand" href="/">
                <span class="brand-icon">
                    <i class="bi bi-buildings"></i>
                </span>
                City<span>Pulse</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <i class="bi bi-list"></i>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">

                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#how-it-works">How It Works</a>
                    </li>
                </ul>

                <div class="navbar-actions">
                    <a href="{{ route('login') }}" class="btn-login">
                        Sign In
                    </a>

                    <a href="{{ route('register') }}" class="btn-primary-custom">
                        Get Started <i class="bi bi-arrow-up-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </nav>

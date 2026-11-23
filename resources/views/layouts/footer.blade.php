<footer class="city-footer">

    <div class="container">

        <div class="row g-4">

            <div class="col-lg-5">

                <a class="navbar-brand footer-brand" href="/">
                    <span class="brand-icon">
                        <i class="bi bi-buildings"></i>
                    </span>
                    City<span>Pulse</span>
                </a>

                <p class="footer-description">
                    Connecting citizens, technology, and government
                    services to build smarter urban communities.
                </p>

            </div>

            <div class="col-6 col-lg-2">

                <h6>Platform</h6>

                <a href="#about">About Us</a>
                <a href="#services">Services</a>
                <a href="#how-it-works">How It Works</a>

            </div>

            <div class="col-6 col-lg-2">

                <h6>Account</h6>

                <a href="{{ route('login') }}">Sign In</a>
                <a href="{{ route('register') }}">Register</a>

            </div>

            <div class="col-lg-3">

                <h6>Discover CityPulse</h6>

                <p class="footer-small">
                    A smarter approach to urban management.
                </p>

            </div>

        </div>

        <div class="footer-bottom">

            <span>© {{ date('Y') }} CityPulse. All rights reserved.</span>

            <span>Designed for smarter cities.</span>

        </div>

    </div>

</footer>

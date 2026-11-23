<section class="services-section section-padding" id="services">

    <div class="container">

        <div class="services-heading">

            <div>
                <span class="section-eyebrow">WHAT WE DO</span>

                <h2>
                    One platform.
                    <span>Multiple solutions.</span>
                </h2>
            </div>

            <p>
                From infrastructure problems to environmental concerns,
                CityPulse helps organize the services that keep cities running.
            </p>

        </div>

        <div class="row g-3">

            @php
                $services = [
                    ['bi-cone-striped', 'Road Maintenance', 'Road damage, potholes and infrastructure concerns.'],
                    ['bi-lightbulb', 'Street Lighting', 'Public lighting issues and damaged street lamps.'],
                    ['bi-recycle', 'Waste Management', 'Waste collection and environmental cleanliness.'],
                    ['bi-stoplights', 'Traffic Management', 'Traffic signals and road obstruction reports.'],
                    ['bi-building', 'Public Infrastructure', 'Public facilities and infrastructure maintenance.'],
                    ['bi-geo-alt', 'Location Intelligence', 'Location-based complaint monitoring and analysis.'],
                ];
            @endphp

            @foreach ($services as $service)
                <div class="col-md-6 col-lg-4">

                    <div class="service-card">

                        <div class="service-icon">
                            <i class="bi {{ $service[0] }}"></i>
                        </div>

                        <h5>{{ $service[1] }}</h5>

                        <p>{{ $service[2] }}</p>

                        <i class="bi bi-arrow-up-right service-arrow"></i>

                    </div>

                </div>
            @endforeach

        </div>

    </div>

</section>

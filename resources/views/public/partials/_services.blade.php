<section id="services" class="services section">

    <div class="container section-title" data-aos="fade-up">
        <h2>Program</h2>
        <div><span>Check Our</span> <span class="description-title">Program</span></div>
    </div>

    <div class="container">
        <div class="row gy-4">

            {{-- LOOP THROUGH DATABASE --}}
            @foreach ($programs as $index => $program)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ 400 + $index * 100 }}">
                    <div class="service-item position-relative">
                        <div class="icon">
                            {{-- Use the dynamic icon from DB --}}
                            <i class="bi {{ $program->icon }}"></i>
                        </div>

                        {{-- Link to Detail Page (We will create this later) --}}
                        {{-- For now, just use # or the slug --}}
                        <a href="{{ url('program/' . $program->slug) }}" class="stretched-link">
                            <h3>{{ $program->program_name }}</h3>
                        </a>

                        {{-- HERE IS THE LONG DESCRIPTION --}}
                        <p>{{ $program->description }}</p>

                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>

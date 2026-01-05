<section id="galeri" class="galeri section">

    {{-- Section Title --}}
    <div class="container section-title" data-aos="fade-up">
        <h2>Galeri</h2>
        <div><span>Intip</span> <span class="description-title">Kegiatan Kami</span></div>
    </div>

    <div class="container">
        <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

            @forelse($galleryImages as $image)
                <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                    <div class="portfolio-content h-100">
                        {{-- 
                             1. Image Link (for GLightbox) 
                             We use the $image->url accessor we created in the Model.
                             We add title attribute so caption shows in lightbox.
                        --}}
                        <a href="{{ $image->url }}" data-gallery="portfolio-gallery-app" class="glightbox"
                            title="{{ $image->title }} - {{ $image->description }}">

                            {{-- 2. Image Thumbnail --}}
                            <img src="{{ $image->url }}" class="img-fluid gallery-image" alt="{{ $image->title }}">
                        </a>
                    </div>
                </div>
            @empty
                {{-- Empty State (Optional) --}}
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada foto kegiatan yang diunggah.</p>
                </div>
            @endforelse

        </div>
    </div>
</section>

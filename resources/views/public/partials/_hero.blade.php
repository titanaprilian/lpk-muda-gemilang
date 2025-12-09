<section id="hero" class="hero section dark-background">

    {{-- Carousel Main Container --}}
    <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

        {{-- Slide 1: Active --}}
        <div class="carousel-item active">
            <img src="{{ asset('assets/img/beranda/jepang.jpeg') }}" class="d-block w-100" alt="Pelatihan di Jepang">
            <div class="carousel-container">
                <h2>Selamat Datang di LPK Muda Gemilang<br></h2>
                <p>LPK Muda Gemilang hadir sebagai lembaga pelatihan dan pendidikan yang berkomitmen untuk mencetak
                    sumber daya manusia unggul dan siap bersaing di dunia kerja, khususnya di Jepang.</p>
            </div>
        </div>

        {{-- Slide 2 --}}
        <div class="carousel-item">
            <img src="{{ asset('assets/img/beranda/fotbar.jpg') }}" class="d-block w-100" alt="Foto Bersama Peserta">
            <div class="carousel-container">
                <h2>LPK Muda Gemilang</h2>
                <p>LPK MUDA GEMILANG telah bekerja sama dengan beberapa SO (Sending Organization) resmi di Indonesia
                    yang berperan dalam proses pengiriman peserta magang ke Jepang. Melalui kerja sama ini, SO
                    membantu memfasilitasi pelatihan, pengurusan berkas, serta pendampingan peserta selama proses
                    persiapan hingga masa magang berlangsung.</p>

            </div>
        </div>

        {{-- Slide 3 --}}
        <div class="carousel-item">
            <img src="{{ asset('assets/img/beranda/pembelajaran.jpg') }}" class="d-block w-100"
                alt="Proses Pembelajaran">
            <div class="carousel-container">
                <h2>LPK Muda Gemilang</h2>
                <p>LPK Muda Gemilang merupakan lembaga pelatihan dan pendidikan resmi dengan nomor izin 02032512201,
                    yang berdedikasi mencetak generasi profesional dan berdaya saing tinggi untuk dunia kerja,
                    khususnya di Jepang.</p>

            </div>
        </div>
        {{-- End Slides Wrapper --}}

        {{-- Previous Button --}}
        <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        {{-- Next Button --}}
        <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

        {{-- Indicators (Updated for Bootstrap 5) --}}
        <ol class="carousel-indicators"></ol>

    </div>

</section>

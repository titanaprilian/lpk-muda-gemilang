<footer id="footer" class="footer dark-background">
    <div class="container footer-top">
        <div class="row gy-4">

            {{-- Column 1: About and Contact Info --}}
            <div class="col-lg-4 col-md-6 footer-about">
                {{-- Updated from route('home') to static slash / --}}
                <a href="/" class="logo d-flex align-items-center">
                    <span class="sitename">LPK Muda Gemilang</span>
                </a>
                <div class="footer-contact pt-3">
                    <p>Jl. Werkudoro, Pijeran Kec. Siman</p>
                    <p>Kabupaten Ponorogo, Jawa Timur 63471</p>
                    <p class="mt-3"><strong>Phone:</strong> <span>0812 6323 0555</span></p>
                    <p><strong>Email:</strong> <span>lpkmudagemilang@gmail.com</span></p>
                </div>
                <div class="social-links d-flex mt-4">
                    {{-- TikTok (External Link) --}}
                    <a href="https://www.tiktok.com/@muda.gemilangofficial" target="_blank">
                        <i class="bi bi-tiktok"></i>
                    </a>
                    {{-- Facebook (External Link) --}}
                    <a href="https://www.facebook.com/Lpkmuda Gemilang" target="_blank">
                        <i class="bi bi-facebook"></i>
                    </a>
                    {{-- Instagram (External Link) --}}
                    <a href="https://www.instagram.com/lpk.mudagemilang" target="_blank">
                        <i class="bi bi-instagram"></i>
                    </a>
                </div>
            </div>

            {{-- Column 2: Useful Links --}}
            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Useful Links</h4>
                <ul>
                    {{-- Updated from route('home')#section to static /#section --}}
                    <li><a href="/#hero">Beranda</a></li>
                    <li><a href="/#about">Tentang Kami</a></li>
                    <li><a href="/#services">Program</a></li>
                    <li><a href="/#galeri">Galeri</a></li>
                    {{-- Updated from route('contact') to static /kontak --}}
                    <li><a href="/kontak">Kontak</a></li>
                </ul>
            </div>

            {{-- Column 3: Program Links --}}
            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Program Kami</h4>
                <ul>
                    {{-- Updated from route('program.pemagangan-jepang') to static URL segment --}}
                    <li><a href="/pemagangan-jepang">Program Pemagangan Jepang</a></li>
                    {{-- Updated from route('program.tokutei-ginou') to static URL segment --}}
                    <li><a href="/tokutei-ginou">Program Visa Kerja (Tokutei Ginou)</a></li>
                    {{-- Updated from route('program.im-japan') to static URL segment --}}
                    <li><a href="/im-japan">Program IM Japan</a></li>
                </ul>
            </div>

            {{-- Column 4: Kritik & Saran (Newsletter Form) --}}
            <div class="col-lg-4 col-md-12 footer-newsletter">
                <h4>Kritik & Saran</h4>
                <p>Kirimkan kritik dan saran Anda untuk membantu LPK Muda Gemilang menjadi lebih baik.</p>

                {{-- Form action is still a POST route, but we'll use a placeholder URL for now --}}
                <form action="/newsletter-subscribe" method="post" class="php-email-form">
                    @csrf {{-- CSRF token is still required for all POST forms in Laravel --}}
                    <div class="newsletter-form">
                        <input type="email" name="email" required>
                        <input type="submit" value="Kirim">
                    </div>
                    {{-- The following divs are typically handled by the form's JavaScript handler (e.g., in assets/js/main.js) --}}
                    <div class="loading">Mengirim...</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Kritik & saran Anda telah terkirim. Terima kasih!</div>
                </form>
            </div>

        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>©<span>Copyright</span> <strong class="px-1 sitename">lpkmudagemilang</strong> <span>All Rights
                Reserved</span></p>
        <div class="credits">
            {{-- Template credits usually go here --}}
        </div>
    </div>

</footer>

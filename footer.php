<footer class="site-footer">
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-widget">
                        <h4>Badan Eksekutif Mahasiswa</h4>
                        <p>Fakultas Hukum Universitas Diponegoro</p>
                        <div class="footer-contact">
                            <p><i class="fas fa-map-marker-alt"></i> Jl. Prof. Soedarto, Tembalang, Semarang</p>
                            <p><i class="fas fa-phone"></i> (024) 7460054</p>
                            <p><i class="fas fa-envelope"></i> bem.fh@undip.ac.id</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="footer-widget">
                        <h4>Quick Links</h4>
                        <ul class="footer-links">
                            <li><a href="<?php echo home_url(); ?>">Beranda</a></li>
                            <li><a href="<?php echo home_url('/tentang'); ?>">Tentang</a></li>
                            <li><a href="<?php echo home_url('/berita'); ?>">Berita</a></li>
                            <li><a href="<?php echo home_url('/kegiatan'); ?>">Kegiatan</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer-widget">
                        <h4>Program Kerja</h4>
                        <ul class="footer-links">
                            <li><a href="#">Advokasi Mahasiswa</a></li>
                            <li><a href="#">Pengembangan SDM</a></li>
                            <li><a href="#">Kegiatan Sosial</a></li>
                            <li><a href="#">Kompetisi Hukum</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer-widget">
                        <h4>Follow Us</h4>
                        <div class="social-links">
                            <a href="#" class="social-link"><i class="fab fa-facebook"></i></a>
                            <a href="https://instagram.com/badaneksekutifmahasiswa" class="social-link"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-tiktok"></i></a>
                        </div>
                        <div class="newsletter">
                            <h5>Newsletter</h5>
                            <form class="newsletter-form">
                                <input type="email" placeholder="Email Anda">
                                <button type="submit"><i class="fas fa-paper-plane"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-content">
                <p>&copy; <?php echo date('Y'); ?> Universitas Diponegoro. All rights reserved.</p>
                <div class="footer-social">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="https://instagram.com/badaneksekutifmahasiswa"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fas fa-rss"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

<?php get_header(); ?>

<main class="main-content">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-slider swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="hero-content">
                        <div class="container">
                            <h1 class="hero-title" data-aos="fade-up">BADAN EKSEKUTIF MAHASISWA</h1>
                            <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="200">Fakultas Hukum Universitas Diponegoro</p>
                            <div class="hero-buttons" data-aos="fade-up" data-aos-delay="400">
                                <a href="#about" class="btn btn-primary">Tentang Kami</a>
                                <a href="#kegiatan" class="btn btn-outline">Kegiatan</a>
                            </div>
                        </div>
                    </div>
                    <div class="hero-overlay"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="about-content" data-aos="fade-right">
                        <h2>Tentang BEM Fakultas Hukum</h2>
                        <p>Badan Eksekutif Mahasiswa Fakultas (BEM-FH) adalah badan pelaksana yang diberi tugas dan tanggung jawab untuk melaksanakan berbagai program kegiatan kemahasiswaan di Fakultas Hukum Universitas Diponegoro.</p>
                        
                        <div class="instagram-link">
                            <a href="https://instagram.com/badaneksekutifmahasiswa" target="_blank" class="instagram-btn">
                                <i class="fab fa-instagram"></i>
                                @badaneksekutifmahasiswa
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-container" data-aos="fade-left">
                        <div class="stat-item">
                            <div class="stat-number" data-count="500">0</div>
                            <div class="stat-label">Mahasiswa Aktif</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number" data-count="25">0</div>
                            <div class="stat-label">Program Kerja</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number" data-count="15">0</div>
                            <div class="stat-label">Pengurus Aktif</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="news-section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Berita Terbaru</h2>
            <div class="news-grid">
                <?php
                $berita_query = new WP_Query(array(
                    'post_type' => 'berita',
                    'posts_per_page' => 6,
                    'post_status' => 'publish'
                ));
                
                if ($berita_query->have_posts()) :
                    while ($berita_query->have_posts()) : $berita_query->the_post();
                ?>
                <article class="news-card" data-aos="fade-up">
                    <div class="news-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('medium'); ?>
                        <?php else : ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.jpg" alt="<?php the_title(); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="news-content">
                        <div class="news-meta">
                            <span class="news-date"><?php echo get_the_date(); ?></span>
                        </div>
                        <h3 class="news-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <p class="news-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                        <a href="<?php the_permalink(); ?>" class="read-more">Baca Selengkapnya</a>
                    </div>
                </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section id="kegiatan" class="events-section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Kegiatan Mendatang</h2>
            <div class="events-slider swiper">
                <div class="swiper-wrapper">
                    <?php
                    $events_query = new WP_Query(array(
                        'post_type' => 'kegiatan',
                        'posts_per_page' => 5,
                        'meta_key' => '_event_date',
                        'orderby' => 'meta_value',
                        'order' => 'ASC'
                    ));
                    
                    if ($events_query->have_posts()) :
                        while ($events_query->have_posts()) : $events_query->the_post();
                        $event_date = get_post_meta(get_the_ID(), '_event_date', true);
                        $event_time = get_post_meta(get_the_ID(), '_event_time', true);
                        $event_location = get_post_meta(get_the_ID(), '_event_location', true);
                    ?>
                    <div class="swiper-slide">
                        <div class="event-card">
                            <div class="event-image">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium'); ?>
                                <?php endif; ?>
                            </div>
                            <div class="event-content">
                                <div class="event-date">
                                    <?php echo date('d M Y', strtotime($event_date)); ?>
                                </div>
                                <h3 class="event-title"><?php the_title(); ?></h3>
                                <div class="event-meta">
                                    <div class="event-time">
                                        <i class="far fa-clock"></i>
                                        <?php echo $event_time; ?>
                                    </div>
                                    <div class="event-location">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <?php echo $event_location; ?>
                                    </div>
                                </div>
                                <p class="event-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn btn-primary">Detail</a>
                            </div>
                        </div>
                    </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- Aspirasi Form Section -->
    <section class="aspirasi-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="section-title" data-aos="fade-right">Sampaikan Aspirasi Anda</h2>
                    <p data-aos="fade-right" data-aos-delay="200">Kami mendengarkan setiap aspirasi dan masukan dari mahasiswa untuk kemajuan fakultas.</p>
                </div>
                <div class="col-md-6">
                    <form id="aspirasi-form" class="aspirasi-form" data-aos="fade-left">
                        <div class="form-group">
                            <input type="text" name="nama" placeholder="Nama Lengkap" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="nim" placeholder="NIM" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <textarea name="aspirasi" placeholder="Tulis aspirasi Anda..." rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Aspirasi</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>

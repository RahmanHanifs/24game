<?php get_header(); ?>

<main class="main-content">
    <div class="archive-header">
        <div class="container">
            <h1 class="archive-title">Kegiatan BEM</h1>
            <p class="archive-description">Daftar kegiatan dan event yang diselenggarakan oleh BEM Fakultas Hukum</p>
        </div>
    </div>
    
    <div class="container">
        <div class="events-archive">
            <?php if (have_posts()) : ?>
                <div class="events-grid">
                    <?php while (have_posts()) : the_post(); 
                        $event_date = get_post_meta(get_the_ID(), '_event_date', true);
                        $event_time = get_post_meta(get_the_ID(), '_event_time', true);
                        $event_location = get_post_meta(get_the_ID(), '_event_location', true);
                    ?>
                        <article class="event-card">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="event-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="event-content">
                                <div class="event-date">
                                    <?php echo date('d M Y', strtotime($event_date)); ?>
                                </div>
                                <h2 class="event-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <div class="event-meta">
                                    <?php if ($event_time) : ?>
                                        <div class="event-time">
                                            <i class="far fa-clock"></i>
                                            <?php echo $event_time; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($event_location) : ?>
                                        <div class="event-location">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <?php echo $event_location; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="event-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="btn btn-primary">Selengkapnya</a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
                
                <div class="pagination">
                    <?php
                    echo paginate_links(array(
                        'prev_text' => '&laquo; Sebelumnya',
                        'next_text' => 'Selanjutnya &raquo;'
                    ));
                    ?>
                </div>
            <?php else : ?>
                <p>Belum ada kegiatan yang dipublikasikan.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>

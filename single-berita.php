<?php get_header(); ?>

<main class="main-content">
    <div class="container">
        <div class="single-post-container">
            <?php while (have_posts()) : the_post(); ?>
                <article class="single-post">
                    <header class="post-header">
                        <div class="post-meta">
                            <span class="post-date"><?php echo get_the_date(); ?></span>
                            <span class="post-author">oleh <?php the_author(); ?></span>
                        </div>
                        <h1 class="post-title"><?php the_title(); ?></h1>
                    </header>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-featured-image">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="post-content">
                        <?php the_content(); ?>
                    </div>
                    
                    <footer class="post-footer">
                        <div class="post-tags">
                            <?php the_tags('Tags: ', ', ', ''); ?>
                        </div>
                        <div class="post-share">
                            <h4>Bagikan:</h4>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="share-btn facebook">
                                <i class="fab fa-facebook"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" target="_blank" class="share-btn twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://wa.me/?text=<?php the_title(); ?> <?php the_permalink(); ?>" target="_blank" class="share-btn whatsapp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </footer>
                </article>
            <?php endwhile; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>

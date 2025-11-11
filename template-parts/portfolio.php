<section id="portfolio" class="portfolio-section">
    <div class="container">
        <h2>Portfolio</h2>

        <div class="portfolio-grid">
            <?php
            $args = array(
                'post_type'      => 'portfolio',
                'posts_per_page' => 3,
                'orderby'        => 'date',
                'order'          => 'DESC',
            );
            $portfolio_query = new WP_Query($args);

            if ($portfolio_query->have_posts()):
                while ($portfolio_query->have_posts()):
                    $portfolio_query->the_post();
                    $link = get_post_meta(get_the_ID(), 'project_link', true);
            ?>

            <div class="portfolio-item">
                <?php if (has_post_thumbnail()): ?>
                    <div class="portfolio-image"><?php the_post_thumbnail('medium'); ?></div>
                <?php endif; ?>

                <h3><?php the_title(); ?></h3>
                <p><?php the_excerpt(); ?></p>

                <?php if ($link): ?>
                    <a href="<?php echo esc_url($link); ?>" class="portfolio-button" target="_blank">
                        Zobrazit projekt
                    </a>
                <?php endif; ?>
            </div>

            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div> <!-- KONEC .portfolio-grid -->

        <!-- ✅ Tohle je mimo grid → zobrazí se pouze jednou pod projekty -->
        <div class="portfolio-show-more-wrapper">
            <a href="<?php echo site_url('/portfolio'); ?>" class="portfolio-show-all">
                Zobrazit všechny projekty →
            </a>
        </div>

    </div>
</section>

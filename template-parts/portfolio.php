<section id="portfolio" class="portfolio-section">
    <div class="container">
        <h2>Portfolio</h2>
        <div class="portfolio-grid">
            <?php
            $args = array(
                'post_type' => 'portfolio',
                'posts_per_page' => -1,
            );
            $portfolio_query = new WP_Query($args);
            if($portfolio_query->have_posts()):
                while($portfolio_query->have_posts()): $portfolio_query->the_post();
                    $link = get_post_meta(get_the_ID(), 'project_link', true); // odkaz z Custom Field
            ?>
            <div class="portfolio-item">
                <?php if(has_post_thumbnail()): ?>
                    <div class="portfolio-image"><?php the_post_thumbnail('medium'); ?></div>
                <?php endif; ?>
                <h3><?php the_title(); ?></h3>
                <p><?php the_excerpt(); ?></p>
                <?php if($link): ?>
                    <a href="<?php echo esc_url($link); ?>" class="portfolio-button" target="_blank">Zobrazit projekt</a>
                <?php endif; ?>
            </div>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>
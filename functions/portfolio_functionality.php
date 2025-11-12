<?php
/**
 * Portfolio functions
 */

/**
 * Display portfolio grid
 *
 * @param int    $posts_per_page Number of portfolio items to display. Default -1 (all).
 * @param string $image_size     WordPress image size. Default 'medium_large'.
 */
function display_portfolio_grid( $posts_per_page = -1, $image_size = 'medium_large' ) {
    $args = array(
        'post_type'      => 'portfolio',
        'posts_per_page' => $posts_per_page,
        'orderby'        => 'date',
        'order'          => 'DESC',
    );
    $portfolio_query = new WP_Query( $args );

    if ( $portfolio_query->have_posts() ) :
        while ( $portfolio_query->have_posts() ) :
            $portfolio_query->the_post();
            $link = get_post_meta( get_the_ID(), 'project_link', true );
            ?>

            <div class="portfolio-item">
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="portfolio-image"><?php the_post_thumbnail( $image_size ); ?></div>
                <?php endif; ?>

                <h3><?php the_title(); ?></h3>
                <p><?php the_excerpt(); ?></p>

                <?php if ( $link ) : ?>
                    <a href="<?php echo esc_url( $link ); ?>" class="portfolio-button" target="_blank">
                        Zobrazit projekt
                    </a>
                <?php endif; ?>
            </div>

            <?php
        endwhile;
        wp_reset_postdata();
    endif;
}

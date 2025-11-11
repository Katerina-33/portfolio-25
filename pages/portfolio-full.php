<?php
/* Template Name: Portfolio Page */
get_header();
?>

<main id="portfolio-page">

    <!-- ✅ Navigace nahoře -->
    <?php get_template_part('template-parts/navigation'); ?>

    <!-- ✅ Mini hero sekce -->
    <section class="portfolio-hero">
        <div class="container">
            <a href="<?php echo site_url('/'); ?>" class="back-button">← Zpět na úvod</a>
            <h1>Moje práce & Projekty</h1>
            <p>Zde najdete kompletní výběr mých projektů – od designu až po vývoj. Průběžně portfolio rozrůstám.</p>
        </div>
    </section>

    <section class="portfolio-list">
        <div class="container">
            <div class="portfolio-grid">
                <?php
                $args = array(
                    'post_type'      => 'portfolio',
                    'posts_per_page' => -1,
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
                        <div class="portfolio-image"><?php the_post_thumbnail('medium_large'); ?></div>
                    <?php endif; ?>
                    <h3><?php the_title(); ?></h3>
                    <p><?php the_excerpt(); ?></p>
                    <?php if ($link): ?>
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

</main>

<?php get_footer(); ?>

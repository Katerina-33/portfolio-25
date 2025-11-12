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
            <br>
            <h1>Moje práce a projekty</h1>
            <p>Zde najdete kompletní výběr mých projektů – od designu až po vývoj. Průběžně portfolio rozrůstám.</p>
        </div>
    </section>

    <section class="portfolio-list">
        <div class="container">
            <div class="portfolio-grid">
                <?php display_portfolio_grid(); ?>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>

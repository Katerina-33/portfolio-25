<section id="portfolio" class="portfolio">
    <div class="container">
        <h2>Portfolio</h2>

        <div class="portfolio-grid">
            <?php display_portfolio_grid( 3, 'medium' ); ?>
        </div> <!-- KONEC .portfolio-grid -->

        <div class="portfolio-show-more-wrapper">
            <a href="<?php echo site_url('/portfolio'); ?>" class="portfolio-show-all">
                Zobrazit všechny projekty →
            </a>
        </div>

    </div>
</section>

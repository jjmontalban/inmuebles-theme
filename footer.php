</div>

<footer class="footer" id="page-footer" role="contentinfo">
    <?php get_sidebar('footer'); ?>
    <div class="site-info row">
        <div class="columns small-12">
            <p>
                <span>&reg;</span>
                <?php echo esc_html(date('Y')) . ' ' . esc_html(get_bloginfo('name')); ?>
            </p>
            <p>
                <?php echo esc_html(get_bloginfo('description')); ?>
                <a href="<?php echo esc_url(get_permalink(3)); ?>">Aviso Legal</a>
            </p>
        </div>
    </div>
</footer>



<?php wp_footer(  ); ?>
</body>
</html>
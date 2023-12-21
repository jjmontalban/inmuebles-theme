</div>

<footer class="footer" id="page-footer" role="contentinfo">
    <?php get_sidebar('footer'); ?>
    <div class="site-info row">
        <div class="columns small-12">
            <p><?php echo esc_html(get_bloginfo('name')); ?></p>
            <p><?php echo esc_html(get_bloginfo('description')); ?></p>
        </div>
    </div>
</footer>


<?php wp_footer(  ); ?>
</body>
</html>
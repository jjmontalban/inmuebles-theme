<div class="row">
    <div class="col-sm-12">
        <nav class="pagination-a">
            <ul class="pagination justify-content-end">
                <?php
                global $wp_query;
                $current_page = max(1, get_query_var('paged'));
                $total_pages = $wp_query->max_num_pages;
                $prev_disabled = ($current_page == 1) ? 'disabled' : '';
                $next_disabled = ($current_page == $total_pages) ? 'disabled' : '';

                // Previous Page Link
                echo '<li class="page-item ' . $prev_disabled . '">';
                echo '<a class="page-link" href="' . get_pagenum_link($current_page - 1) . '">';
                echo '<span class="ion-ios-arrow-back"></span>';
                echo '</a>';
                echo '</li>';

                // Numeric Page Links
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo '<li class="page-item ' . (($current_page == $i) ? 'active' : '') . '">';
                    echo '<a class="page-link" href="' . get_pagenum_link($i) . '">' . $i . '</a>';
                    echo '</li>';
                }

                // Next Page Link
                echo '<li class="page-item ' . $next_disabled . '">';
                echo '<a class="page-link" href="' . get_pagenum_link($current_page + 1) . '">';
                echo '<span class="ion-ios-arrow-forward"></span>';
                echo '</a>';
                echo '</li>';
                ?>
            </ul>
        </nav>
    </div>
</div>

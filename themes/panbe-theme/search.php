<?php

get_header();

?>
</div>
<!-- work section -->
<section class="work_section layout_padding">
    <div class="container">

        <div class="heading_container pb-5">
            <h2>
                Search results</h2>
        </div>

        <h3>You searched for &ldquo;<?php echo esc_html(get_search_query()); ?>&ldquo;</h3>

        <div class="list-group">
            <?php 
            
            if (have_posts()) {
                while(have_posts(  )) {
                    the_post(); 
                    get_template_part('template-parts/content', get_post_type());
                
            } } else {
                echo '<h3>No results match that search.</h3>';
            }

            get_search_form();


?>
        </div>
        <div class="pt-2 pl-2 pagination">
            <?php
        echo paginate_links();
?>
        </div>
</section>
<!-- end work section -->

<?php

get_footer();

?>
<?php

get_header();

?>
</div>
<!-- work section -->
<section class="work_section layout_padding">
    <div class="container">

        <div class="heading_container pb-5">
            <h2>
                Welcome to my blog! </h2>
        </div>

        <div class="list-group">
            <?php 
            
            while(have_posts(  )) {
                the_post(); ?>

            <a href="<? the_permalink(); ?>"
                class="list-group-item list-group-item-action flex-column align-items-start my-2">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">
                        <?php the_title(); ?>
                    </h5>
                    <small>posted <?php the_time( 'F j, Y' ); ?> by <?php the_author(); ?></small>
                </div>
                <p class="mb-1"><?php the_excerpt(  ); ?></p>
                <small>read more &raquo;</small>
            </a>

            <?php }


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
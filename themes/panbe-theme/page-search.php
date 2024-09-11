<?php

get_header();

while (have_posts()) {
    the_post() ?>

</div>


<!-- work section -->
<section class="work_section layout_padding">
    <div class="container">
        <?php 
            $parentId = wp_get_post_parent_id();
            if ($parentId) {

            ?>

        <div class="metabox centered-text dark-gray-link">
            <p><a href="<?php echo get_permalink($parentId); ?>">Back to <?php echo get_the_title($parentId); ?>
                </a>->
                <?php the_title(); ?>
            </p>
        </div>
        <?php
        }
        ?>
        <div class="heading_container">
            <h2>
                <?php the_title(); ?>
            </h2>
        </div>
        <!-- <div class="work_container layout_padding2">
            <div class="box b-1">
                <img src="<?php echo get_theme_file_uri( 'images/w-1.png' ); ?>" alt="">
            </div>
            <div class="box b-2">
                <img src="<?php echo get_theme_file_uri( 'images/w-2.png' ); ?>" alt="">

            </div>
            <div class="box b-3">
                <img src="<?php echo get_theme_file_uri( 'images/w-3.png' ); ?>" alt="">

            </div>
            <div class="box b-4">
                <img src="<?php echo get_theme_file_uri( 'images/w-4.png' ); ?>" alt="">

            </div>
        </div> -->
        <?php get_search_form(); ?>
    </div>
</section>

<!-- end work section -->

<?php }

get_footer();

?>
<?php

get_header();

while(have_posts()) {
    the_post(); ?>

</div>

<section class="work_section layout_padding">
    <div class="container">
        <div class="metabox dark-gray-link">
            <p><a href="<?php echo site_url('/blog') ?>">Blog Home</a> -> posted <?php the_time( 'F j, Y' ); ?> by
                <?php the_author_posts_link(); ?> in <?php echo get_the_category_list(', '); ?>
            </p>
        </div>
        <div class="heading_container">
            <h2>
                <?php the_title(); ?>
            </h2>
        </div>
        <div>
            <?php the_content(); ?>
        </div>
    </div>
</section>

<?php }

get_footer();

?>
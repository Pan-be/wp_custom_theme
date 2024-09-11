<?php

get_header();

while(have_posts()) {
    the_post(); ?>

</div>

<section class="work_section layout_padding">
    <div class="container">
        <div class="metabox dark-gray-link">
            <p><a href="<?php echo get_post_type_archive_link('tutorial'); ?>">All Tutorials</a> ->
                <?php the_title(); ?>
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

        <?php
        
        $relatedPrograms = get_field('related_programs');

        if ($relatedPrograms) {

        // print_r($relatedPrograms)
        echo '<ul class="list-group programs">';
        foreach ($relatedPrograms as $program) { ?>
        <li class="list-group-item"><a
                href="<?php echo get_the_permalink($program); ?>"><?php echo get_the_title($program); ?></a></li>
        <?php
        };
        echo '</ul>';

    }
        ?>
    </div>
</section>

<?php }

get_footer();

?>
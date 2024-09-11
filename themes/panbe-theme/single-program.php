<?php

get_header();

while(have_posts()) {
    the_post(); ?>

</div>

<section class="work_section layout_padding">
    <div class="container">
        <div class="metabox dark-gray-link">
            <p><a href="<?php echo get_post_type_archive_link('program'); ?>">All Programs</a> -> <?php the_title(); ?>
            </p>
        </div>
        <div class="heading_container">
            <h2>
                <?php the_title(); ?>
            </h2>
        </div>
        <div>
            <?php the_field('main_body_content'); ?>
        </div>
        <?php 

echo '<div class="heading_container my-4"><h2>Your tutors:</h2>';
echo '<ul class="list-group programs">';

$relatedTutors = new WP_Query(array(
    'post_per_page' => -1,
    'post_type' => 'tutor',
    'orderby'=> 'title',
    'order'=> 'ASC',
    'meta_query' => array(
        array(
            'key' => 'related_programs',
            'compare' => 'LIKE',
            'value' => '"' . get_the_ID() . '"'
            )
            )
        ));
        
        while($relatedTutors->have_posts()) {
            $relatedTutors->the_post(); ?>

        <li class="card" style="width: 18rem;">
            <a href="<?php echo get_the_permalink(); ?>">
                <img src="<?php the_post_thumbnail_url(null,'tutorLandscalse'); ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo get_the_title(); ?></h5>

                </div>
            </a>
        </li>
        <?php  
}
echo '</ul></div>';

wp_reset_postdata(  );

echo '<div class="heading_container my-4"><h2>Check the tutorial below</h2>';
        echo '<ul class="list-group programs">';

        $programPageTutorial = new WP_Query(array(
          'post_type' => 'tutorial',
          'meta_query' => array(
            array(
              'key' => 'related_programs',
              'compare' => 'LIKE',
              'value' => '"' . get_the_ID() . '"'
            )
          )
        ));

                while($programPageTutorial->have_posts()) {
                   $programPageTutorial->the_post(); ?>
        <li class="list-group-item"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
        <?php  
}
echo '</ul></div>'; ?>
    </div>


</section>

<?php }

get_footer();

?>
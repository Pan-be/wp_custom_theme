<?php

get_header();

while(have_posts()) {
    the_post(); ?>

</div>

<section class="work_section layout_padding">
    <div class="container">

        <div class="heading_container">
            <h2>
                <?php the_title(); ?>
            </h2>
        </div>
        <div>

        </div>
        <div class="media">

            <img class="mr-3 w-25 rounded" src="<?php echo get_the_post_thumbnail_url(null, 'tutorPortrait'); ?>">

            <div class="tutor-content-box media-body">
                <?php the_content(); 
                    $likeCount = new WP_Query(array(
                        'post_type' => 'like',
                        'meta_query' => array(
                            array(
                                'key' => 'liked_tutor_id',
                                'compare' => '=',
                                'value' => get_the_ID()
                            )
                        )
                            ));    
                            
                    $existStatus = 'no';

                    if (is_user_logged_in()) {

                        $existQuery = new WP_Query(array(
                            'author' => get_current_user_id(),
                            'post_type' => 'like',
                            'meta_query' => array(
                                array(
                                    'key' => 'liked_tutor_id',
                                    'compare' => '=',
                                    'value' => get_the_ID()
                                )
                            )
                                ));   
                                
                        if ($existQuery->found_posts) {
                        $existStatus = 'yes';
                        }
                    }

                ?>
                <div class="like-box"
                    data-like="<?php if (isset($existQuery->posts[0]->ID)) echo $existQuery->posts[0]->ID; ?>"
                    data-tutor="<?php the_ID(); ?>" data-exist="<?php echo $existStatus; ?>">
                    <svg version="1.1" id="Layer_1" x="0px" y="0px" width="40px" viewBox="0 0 426.668 426.668"
                        style="enable-background:new 0 0 426.668 426.668;" xml:space="preserve">
                        <path d="M401.788,74.476c-63.492-82.432-188.446-33.792-188.446,49.92
        c0-83.712-124.962-132.356-188.463-49.92c-65.63,85.222-0.943,234.509,188.459,320.265
        C402.731,308.985,467.418,159.698,401.788,74.476z" />
                    </svg>
                    <span id="like-count"><?php echo $likeCount->found_posts; ?></span>
                </div>
            </div>
        </div>

        <?php
        
        $relatedPrograms = get_field('related_programs');

        if ($relatedPrograms) {

        // print_r($relatedPrograms)
        echo '<ul class="list-group programs pt-5">';
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
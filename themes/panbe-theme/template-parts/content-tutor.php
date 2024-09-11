<li class="card" style="width: 18rem;">
    <a href="<?php echo get_the_permalink(); ?>">
        <img src="<?php the_post_thumbnail_url(null,'tutorLandscalse'); ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?php echo get_the_title(); ?></h5>

        </div>
    </a>
</li>
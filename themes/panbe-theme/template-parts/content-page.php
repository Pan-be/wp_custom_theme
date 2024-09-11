<a href="<? the_permalink(); ?>" class="list-group-item list-group-item-action flex-column align-items-start my-2">
    <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1">
            <?php the_title(); ?>
        </h5>
    </div>
    <p class="mb-1"><?php the_excerpt(  ); ?></p>
    <small>read more &raquo;</small>
</a>
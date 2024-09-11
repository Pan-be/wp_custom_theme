<?php

if(!is_user_logged_in()) {
    wp_redirect( esc_url(site_url()) );
    exit;
}

get_header();

while (have_posts()) {
    the_post() ?>

</div>


<!-- work section -->
<section class="work_section layout_padding">
    <div class="container">


        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="well well-sm">
                    <form class="form-horizontal" action="" method="post" id="new-note">
                        <fieldset>
                            <legend class="text-left col-md-9">Create New Note</legend>

                            <!-- Name input-->
                            <div class="form-group">
                                <div class="col-md-9">
                                    <input id="new-note-title" name="new-note-title" type="text" placeholder="Title"
                                        class="form-control">
                                </div>
                            </div>

                            <!-- Message body -->
                            <div class="form-group">

                                <div class="col-md-9">
                                    <textarea class="form-control" id="new-note-body" name="new-note-body"
                                        placeholder="Please enter your note here..." rows="5"></textarea>
                                </div>
                            </div>

                            <!-- Form actions -->
                            <div class="form-group">
                                <div class="col-md-12 text-left d-flex gap-3">
                                    <button type="submit" class="submit-note btn btn-secondary btn-lg">Save</button>
                                    <div class="pl-3 warning-text" hidden><span class="text-danger">Note limit
                                            reached: delete an
                                            existing
                                            note to
                                            make
                                            room
                                            for a new one.</span></div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            <ul id="my-notes" class="list-group">
                <?php 
                $userNotes = new WP_Query(array(
                    'post_type' => 'note',
                    'post_per_type' => -1,
                    'author' => get_current_user_id()
                ));

                while($userNotes->have_posts()) {
                    $userNotes->the_post(); ?>
                <li class="list-group-item" data-id="<?php the_ID(); ?>">

                    <div class="input-group mb-3">
                        <button class="btn btn-light note-control-btn edit-note-button" type="button"><svg version="1.1"
                                id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="128px" height="128px"
                                viewBox="0 0 128 128" enable-background="new 0 0 128 128" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M8,112V16c0-4.414,3.594-8,8-8h80c4.414,0,8,3.586,8,8v47.031l8-8V16c0-8.836-7.164-16-16-16H16C7.164,0,0,7.164,0,16v96
			c0,8.836,7.164,16,16,16h44v-8H16C11.594,120,8,116.414,8,112z M88,24H24v8h64V24z M88,40H24v8h64V40z M88,56H24v8h64V56z M24,80
			h32v-8H24V80z M125.656,72L120,66.344c-1.563-1.563-3.609-2.344-5.656-2.344s-4.094,0.781-5.656,2.344l-34.344,34.344
			C72.781,102.25,68,108.293,68,110.34L64,128l17.656-4c0,0,8.094-4.781,9.656-6.344l34.344-34.344
			C128.781,80.188,128.781,75.121,125.656,72z M88.492,114.82c-0.453,0.43-2.02,1.488-3.934,2.707l-10.363-10.363
			c1.063-1.457,2.246-2.922,2.977-3.648l25.859-25.859l11.313,11.313L88.492,114.82z" />
                                    </g>
                                </g>
                            </svg>
                        </button>
                        <div hidden class="edit-mode-buttons flex-column">
                            <button class="btn btn-light note-control-btn save-note-button" type="button"><svg
                                    version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 32 32"
                                    style="enable-background:new 0 0 32 32;" xml:space="preserve" width="128px"
                                    height="128px">
                                    <g>
                                        <g>
                                            <path style="fill:#010002;"
                                                d="M26,0h-2v13H8V0H0v32h32V6L26,0z M28,30H4V16h24V30z" />
                                            <rect x="6" y="18" style="fill:#010002;" width="20" height="2" />
                                            <rect x="6" y="22" style="fill:#010002;" width="20" height="2" />
                                            <rect x="6" y="26" style="fill:#010002;" width="20" height="2" />
                                            <rect x="18" y="2" style="fill:#010002;" width="4" height="9" />
                                        </g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                </svg>

                            </button>
                            <button class="btn btn-light note-control-btn back-button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" />
                                </svg>
                            </button>
                        </div>
                        <div>
                            <input readonly class="note-title-field"
                                value="<?php echo str_replace('Private:', '', esc_attr(get_the_title())); ?>">
                            <textarea readonly
                                class="note-body-field"><?php echo esc_textarea(wp_strip_all_tags(get_the_content())); ?></textarea>
                        </div>
                        <button class="btn btn-danger note-control-btn remove-note-button" type="button"><svg
                                height="137px" style="enable-background:new 0 0 98 137;" version="1.1"
                                viewBox="0 0 98 137" width="98px" xml:space="preserve"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path fill="white"
                                    d="M75.6,44.8v73c0,3.4-2.8,6.2-6.2,6.2H21.3c-3.4,0-6.2-2.8-6.2-6.2v-73H75.6L75.6,44.8z M59.9,52.9v62.8h3.6V52.9H59.9  L59.9,52.9z M43.6,52.9v62.8h3.6V52.9H43.6L43.6,52.9z M27.3,52.9v62.8h3.6V52.9H27.3L27.3,52.9z M31.3,27.9v-5.2  c0-3.3,2.6-5.9,5.9-5.9h16.4c3.3,0,5.9,2.6,5.9,5.9v5.2h18.1c3.4,0,6.2,2.8,6.2,6.2v4.3H7V34c0-3.4,2.8-6.2,6.2-6.2H31.3L31.3,27.9z   M37.2,20.8c-1,0-1.8,0.8-1.8,1.8v5.2h20.1v-5.2c0-1-0.8-1.8-1.8-1.8H37.2L37.2,20.8z" />
                                <rect fill="none" height="137" id="_x3C_Slice_x3E__100_" width="98" />
                            </svg>
                        </button>
                    </div>

                </li>
                <?php }
            ?>

        </div>
</section>

<!-- end work section -->

<?php }

get_footer();

?>
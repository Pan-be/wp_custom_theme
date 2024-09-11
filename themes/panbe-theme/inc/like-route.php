<?php

add_action('rest_api_init', 'panbeLikeRoutes');

function panbeLikeRoutes() {
    register_rest_route('panbe/v1', 'manageLike', array(
        'methods' => 'POST',
        'callback' => 'createLike'
    ));
    register_rest_route('panbe/v1', 'manageLike', array(
        'methods' => 'DELETE',
        'callback' => 'deleteLike'
    ));
}

function createLike($data) {

    if (is_user_logged_in()) {
        
        $tutor = sanitize_text_field($data['tutorId']);

        $existQuery = new WP_Query(array(
            'author' => get_current_user_id(),
            'post_type' => 'like',
            'meta_query' => array(
                array(
                    'key' => 'liked_tutor_id',
                    'compare' => '=',
                    'value' => $tutor
                )
            )
                ));  

        if ($existQuery->found_posts == 0 && get_post_type($tutor) == 'tutor') {
            return wp_insert_post(array(
                'post_type' => 'like',
                'post_status' => 'publish',
                'post_title' => '2bla bla',
                'meta_input' => array(
                    'liked_tutor_id' => $tutor
                )
            ));

        } else {
            die('invalid tutor id');
        }
    } else {
        die('only logged in users can create al like.');
    }

}

function deleteLike($data) {
    $likeId = sanitize_text_field($data['like']);
    if(get_current_user_id() == get_post_field('post_author', $likeId) && get_post_type($likeId) == 'like') {
        wp_delete_post($likeId, true);
    } else {
        die('you dont have permisssion to delete');
    }
}
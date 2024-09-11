<?php

require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
require get_theme_file_path('/inc/like-route.php');
// require get_template_directory() . '/inc/search-route.php';
require get_theme_file_path('/inc/search-route.php');

function panbe_custom_rest() {
    register_rest_field('post', 'authorName', array(
        'get_callback' => function () {
            return get_the_author();
        }
    ));
    register_rest_field('note', 'userNoteCount', array(
        'get_callback' => function () {
            return count_user_posts(get_current_user_id(), 'note');
        }
    ));
    }

add_action('rest_api_init', 'panbe_custom_rest');

function panbe_files(){

    wp_enqueue_script( 'bootstrap-js', get_theme_file_uri( '/js/bootstrap.js' ), array('jquery-js'), '1.0', true );
    wp_enqueue_script( 'jquery-js', get_theme_file_uri( '/js/jquery-3.4.1.min.js' ), null, '1.0', true );
    wp_enqueue_script( 'owl-carousel-cdn', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js' , null, '1.0', true );
    wp_enqueue_script( 'owl-carousel-js', get_theme_file_uri( '/js/owl-carousel.js' ), array('jquery-js', 'owl-caousel-cdn'), '1.0', true );

    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,700&display=swap' );
    wp_enqueue_style( 'owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css' );
    wp_enqueue_script('panbe_main_js', get_theme_file_uri( 'build/index.js' ));
    wp_enqueue_style( 'panbe_bootstrap_styles', get_theme_file_uri( '/css/bootstrap.css' ) );
    wp_enqueue_style( 'panbe_main_styles', get_theme_file_uri( '/css/style.css' ) );
    wp_enqueue_style( 'panbe_responsive_styles', get_theme_file_uri( '/css/responsive.css' ) );

    wp_localize_script('panbe_main_js', 'panbe_data', array(
        'root_url' => get_site_url(),
        'nonce' => wp_create_nonce('wp_rest')
    ));
}

add_action( 'wp_enqueue_scripts', 'panbe_files' );

function panbe_features() {
    register_nav_menu( 'headerMenuLocation', 'Header Menu Location' );
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('tutorLandscale', 400, 260, true);
    add_image_size('tutorPortrait', 480, 650, true);
}

add_action( 'after_setup_theme', 'panbe_features' );

function panbe_adjust_queries($query) {
    if (!is_admin() && is_post_type_archive('program') && is_main_query()) {
        $query->set('orderby', 'title');
        $query-> set('order', 'ASC');
        $query->set('post_per_page', -1);
    }
}

add_action('pre_get_posts', 'panbe_adjust_queries');

// Redirect subscriber accounts out of admin and onto homepage
add_action( 'admin_init', 'redirectSubsToFrontend');


function redirectSubsToFrontend() {
    $currentUser = wp_get_current_user(  );

    if (count($currentUser->roles) == 1 && $currentUser->roles[0] == 'subscriber') {
        wp_redirect(site_url('/'));
        exit;
    }
}

add_action( 'wp_loaded', 'noAdminBar');


function noAdminBar() {
    $currentUser = wp_get_current_user(  );

    if (count($currentUser->roles) == 1 && $currentUser->roles[0] == 'subscriber') {
        show_admin_bar(false);
    }
}

// customize login screen
add_filter( 'login_headerurl', 'ourHeaderUrl');

function ourHeaderUrl() {
    return esc_url(site_url('/'));
}

add_action( 'login_enqueue_scripts', 'ourLoginCSS' );

function ourLoginCSS() {
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,700&display=swap' );
    wp_enqueue_style( 'owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css' );
    wp_enqueue_style( 'panbe_bootstrap_styles', get_theme_file_uri( '/css/bootstrap.css' ) );
    wp_enqueue_style( 'panbe_main_styles', get_theme_file_uri( '/css/style.css' ) );
    wp_enqueue_style( 'panbe_responsive_styles', get_theme_file_uri( '/css/responsive.css' ) );
}

add_filter( 'login_headertitle', 'ourLoginTitle');

function ourLoginTitle() {
    return get_bloginfo( 'name' );    
}

// force note post to be private

// add_filter('wp_insert_post_data', 'makeNotePrivate', 10, 2);

// function makeNotePrivate($data, $postarr) {
    
//     if($data['post_type'] == 'note') {
//         if(count_user_posts(get_current_user_id(), 'note' ) > 4 && !$postarr['ID']) {
//             die("You have reached your note limit.");
//         }
//         $data['post_content'] = sanitize_textarea_field($data['post_content']);
//         $data['post_title'] = sanitize_text_field($data['post_title']);
//     }
    
//     if($data['post_type'] == 'note' && $data['post_status'] != 'trash') {
//         $data['post_status'] = "private";
//     }
//     return $data;
// }

function makeNotePrivate($data, $postarr) {

    if ($data['post_type'] == 'note') {
        // Sprawdzenie, czy ID nie istnieje, co oznacza nowy post
        if (empty($postarr['ID']) && count_user_posts(get_current_user_id(), 'note') >= 4) {
            die("You have reached your note limit.");
        }
        
        $data['post_content'] = sanitize_textarea_field($data['post_content']);
        $data['post_title'] = sanitize_text_field($data['post_title']);
    }

    if ($data['post_type'] == 'note' && $data['post_status'] != 'trash') {
        $data['post_status'] = "private";
    }

    return $data;
}

add_filter('wp_insert_post_data', 'makeNotePrivate', 10, 2);


?>
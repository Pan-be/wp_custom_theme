<?php

function panbe_post_types() {
    register_post_type('tutorial', array(
        'capability_type' => 'tutorial',
        'map_meta_cap' => true,
        'supports' => array('title', 'editor', 'excerpt'),
        'rewrite' => array('slug' => 'tutorials'),
        'has_archive' => true,
        'public' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-hammer',
        'labels' => array(
            'name' => 'Tutorials',
            'add_new' => 'Add New Tutorial',
            'add_new_item' => 'Add New Tutorial',
            'edid_item' => 'Edit Tutorial',
            'all_items' => 'Tutorials',
            'singular_name' => 'Tutorial'
        )
    ));
    
    register_post_type('video', array(
        'supports' => array('title', 'editor', 'excerpt', 'custom-fields'),
        'rewrite' => array('slug' => 'videos'),
        'has_archive' => true,
        'public' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-video-alt3',
        'labels' => array(
            'name' => 'Videos',
            'add_new' => 'Add New Video',
            'add_new_item' => 'Add New Video',
            'edid_item' => 'Edit Video',
            'all_items' => 'Videos',
            'singular_name' => 'Video'
        )
    ));

    register_post_type('program', array(
        'supports' => array('title', 'custom-fields'),
        'rewrite' => array('slug' => 'programs'),
        'has_archive' => true,
        'public' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-awards',
        'labels' => array(
            'name' => 'Programs',
            'add_new' => 'Add New Program',
            'add_new_item' => 'Add New Program',
            'edid_item' => 'Edit Program',
            'all_items' => 'Programs',
            'singular_name' => 'Program'
        )
    ));
    register_post_type('tutor', array(
        'supports' => array('title', 'editor', 'custom-fields', 'thumbnail'),
        'public' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'labels' => array(
            'name' => 'Tutors',
            'add_new' => 'Add New Tutor',
            'add_new_item' => 'Add New Tutor',
            'edid_item' => 'Edit Tutor',
            'all_items' => 'Tutors',
            'singular_name' => 'Tutor'
        )
    ));

    register_post_type('note', array(
        'capability_type' => 'note',
        'map_meta_cap' => true,
        'supports' => array('title', 'editor'),
        'public' => false,
        'show_ui' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-welcome-write-blog',
        'labels' => array(
            'name' => 'Notes',
            'add_new' => 'Add New Note',
            'add_new_item' => 'Add New Note',
            'edid_item' => 'Edit Note',
            'all_items' => 'Notes',
            'singular_name' => 'Note'
        )
    ));

    register_post_type('like', array(
        'supports' => array('title'),
        'public' => false,
        'show_ui' => true,
        'menu_icon' => 'dashicons-heart',
        'labels' => array(
            'name' => 'Likes',
            'add_new' => 'Add New Like',
            'add_new_item' => 'Add New Like',
            'edid_item' => 'Edit Like',
            'all_items' => 'Likes',
            'singular_name' => 'Like'
        )
    ));
};



add_action('init', 'panbe_post_types');

?>
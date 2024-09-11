<?php

add_action('rest_api_init', 'panbeRegisterSearch');

function panbeRegisterSearch() {
    register_rest_route('panbe/v1', 'search', array(
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'panbeSearchResults'
    ));
}

function panbeSearchResults($data) {
    $query = new WP_Query(array(
        'post_type' => array('post', 'page', 'tutor', 'tutorial', 'program'),
        's' => sanitize_text_field($data['term'])
    ));

    $results = array(
        'generalInfo' => array(),
        'tutors' => array(),
        'tutorials' => array(),
        'programs' => array()
    );

    while ($query->have_posts()) {
        $query->the_post();
       if (get_post_type() == 'post' || get_post_type() == 'page') {
        array_push($results['generalInfo'], array(
            'title' => get_the_title(),
            'permalink' => get_the_permalink(),
            'postType' => get_post_type(),
            'authorName' => get_the_author()
        ));
    };
       if (get_post_type() == 'tutor'){
        array_push($results['tutors'], array(
            'title' => get_the_title(),
            'permalink' => get_the_permalink(),
            'img' => get_the_post_thumbnail_url(0, 'tutorLandscalse')
        ));
    };
       if (get_post_type() == 'tutorial'){
        array_push($results['tutorials'], array(
            'title' => get_the_title(),
            'permalink' => get_the_permalink()
        ));
    };
       if (get_post_type() == 'program'){
        array_push($results['programs'], array(
            'title' => get_the_title(),
            'permalink' => get_the_permalink(),
            'id' => get_the_id()
        ));
    }
    }

    if ($results['programs']) {

        $programsMetaQuery = array('relation' => 'OR');
    
        foreach($results['programs'] as $item) {
            array_push($programsMetaQuery, array(
                    'key' => 'related_programs',
                    'compare' => 'LIKE',
                    'value' => '"'. $item['id'] . '"'
            ));
        }
    
        $programRelationshipQuery = new WP_Query(array(
            'post_type' => array('tutor', 'tutorial'),
            'meta_query' => $programsMetaQuery
                ));
    
        while($programRelationshipQuery->have_posts()) {
            $programRelationshipQuery->the_post();

            if (get_post_type() == 'tutorial'){
                array_push($results['tutorials'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink()
                ));
            };

            if (get_post_type() == 'tutor'){
                array_push($results['tutors'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                    'img' => get_the_post_thumbnail_url(0, 'tutorLandscalse')
                ));
            };
        }
    
        $results['tutors'] = array_values(array_unique($results['tutors'], SORT_REGULAR));
        $results['tutorials'] = array_values(array_unique($results['tutorials'], SORT_REGULAR));
    }


    return $results;

}
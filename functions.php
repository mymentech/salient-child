<?php

include_once get_theme_file_path('/inc/tgm.php');
include_once get_theme_file_path('/inc/scripts-manager.php');

function diy_register_nav_menus() {
    register_nav_menus(array(
        'course_menu' => 'Course Menu',
    ));
}

add_action('after_setup_theme', 'diy_register_nav_menus');


/**
 * @param $post_id
 * @return mixed|string
 */
function mt_get_post_content($post_id) {
    $content_post = get_post($post_id);
    $content      = $content_post->post_content;
    $content      = apply_filters('the_content', $content);
    return $content;
}


function mt_course_nonce_function() {
    $post_id  = $_POST['post_id'];
    $mt_nonce = $_POST['mt_nonce'];

    echo mt_get_post_content($post_id);
    die();
}

add_action('wp_ajax_mt_course_nonce', 'mt_course_nonce_function');












<?php

add_action('wp_enqueue_scripts', 'salient_child_enqueue_styles');
function salient_child_enqueue_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css', array('font-awesome'));
    if (is_rtl())
        wp_enqueue_style('salient-rtl', get_template_directory_uri() . '/rtl.css', array(), '1', 'screen');

    //Adding css and scripts for course template.

    if (is_singular('course')) {
        wp_enqueue_style('course-google-font', "https://fonts.googleapis.com/css?family=Roboto");
        wp_enqueue_style('course-bootstrap-css', get_theme_file_uri('/course/css/bootstrap.min.css'));
        wp_enqueue_style('course-style', get_theme_file_uri('/course/css/style.css'), null, time());
        wp_enqueue_style('salient-child-style', get_theme_file_uri('style.css'), null, time());

        wp_enqueue_script('course-font-awesome-js', get_theme_file_uri('/course/js/font-awesome.js'));
        wp_enqueue_script('course-bootstrap-js', get_theme_file_uri('/course/js/bootstrap.min.js'), array('jquery'));
        wp_enqueue_script('youtube-iframe-api', '//www.youtube.com/iframe_api', array('jquery'), '0.0.1', true);
        wp_enqueue_script('vimeo-player-api', '//player.vimeo.com/api/player.js', null, '0.0.1', true);
        wp_enqueue_script('course-main-js', get_theme_file_uri('/js/diy-main.js'), null, time(), true);


        $course_meta     = get_post_meta(get_the_ID(), 'course-meta-info', true);
        $has_intro_video = $course_meta['intro_video_check'];
        $video_id        = '';
        $video_type      = '';
        if ($has_intro_video) {
            $video_id   = $course_meta['intro_video'];
            $video_type = $course_meta['intro_video_type'];
        }

        $admin_url = array(
            'url'             => get_admin_url(),
            'has_intro_video' => $has_intro_video,
            'video_id'        => $video_id,
            'video_type'      => $video_type,
        );

        wp_localize_script('course-main-js', 'adminUrl', $admin_url);

    }
}

add_action('wp_enqueue_scripts', 'salient_child_mt_scripts', 99999);
function salient_child_mt_scripts() {
    if (is_singular('course')) {
        wp_deregister_style('main-styles');
        wp_deregister_style('parent-style');
        wp_deregister_style('rgs');
        wp_deregister_style('font-awesome');
        wp_deregister_style('fancyBox');
        wp_deregister_style('responsive');
        wp_deregister_style('woocommerce');
        wp_deregister_style('skin-ascend');
        wp_deregister_style('rgs');
        wp_deregister_style('orbit');
        wp_deregister_style('twentytwenty');
        wp_deregister_style('woocommerce');
        wp_deregister_style('font-awesome');
        wp_deregister_style('iconsmind');
        wp_deregister_style('linea');
        wp_deregister_style('fullpage');
        wp_deregister_style('nectarslider');
        wp_deregister_style("main-styles");
        wp_deregister_style("nectar-portfolio");
        wp_deregister_style("magnific");
        wp_deregister_style("fancyBox");
        wp_deregister_style("responsive");
        wp_deregister_style("select2");
        wp_deregister_style("non-responsive");
        wp_deregister_style("skin-ascend");
        wp_deregister_style("skin-material");
        wp_deregister_style("box-roll");
        wp_deregister_style("nectar-ie8");
        wp_deregister_style("style-css");
        wp_deregister_style("font-awesome-latest");
        wp_deregister_style("woocommerce-general");
        wp_deregister_style("woocommerce-smallscreen");
        wp_deregister_style("woocommerce-layout");
        wp_deregister_style("image-hover-effects-css");
        wp_deregister_style("contact-form-7");


        wp_deregister_script('modernizer');
        wp_deregister_script('respond');
        wp_deregister_script('superfish');
        wp_deregister_script('respond');
        wp_deregister_script('touchswipe');
        wp_deregister_script('flexslider');
        wp_deregister_script('orbit');
        wp_deregister_script('flickity');
        wp_deregister_script('nicescroll');
        wp_deregister_script('sticky');
        wp_deregister_script('magnific');
        wp_deregister_script('fancyBox');
        wp_deregister_script('nectar_parallax');
        wp_deregister_script('isotope');
        wp_deregister_script('select2');
        wp_deregister_script('nectarSlider');
        wp_deregister_script('iosSlider');
        wp_deregister_script('fullPage');
        wp_deregister_script('vivus');
        wp_deregister_script('nectarParticles');
        wp_deregister_script('ajaxify');
        wp_deregister_script('caroufredsel');
        wp_deregister_script('owl_carousel');
        wp_deregister_script('midnight');
        wp_deregister_script('twentytwenty');
        wp_deregister_script('stickykit');

    }
}

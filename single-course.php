<?php
$post_id = get_the_ID();
$course_meta_info = get_post_meta($post_id,'course-meta-info',true);
$wc_product_id = $course_meta_info['wc_product'];
$chapters = $course_meta_info['chapters'];


$purchased_this_course = apply_filters('current_user_purchased','not_purchased',$wc_product_id);

?>
<?php get_header('course') ?>
<?php if($purchased_this_course=='not_purchased'): ?>
<div class="container">
    <div class="row">
        <div class="well well-lg text-center">
            <h2 class="text-danger text-center"><?php _e("You are Enrolled!","mt_addon") ?></h2>
            <p class="text-center text-warning"><?php _e("You are not enrolled to this cour yet. Please purchase the course and back to this again.") ?></p>
            <a class="text-center" href="<?php echo esc_url(get_permalink($wc_product_id)) ?>" target="_blank">
                <button class="btn btn-primary btn-lg">
                    <?php _e("Purchase Course") ?>
                </button>
            </a>

        </div>
    </div>
</div>
<?php else: ?>
<div class = "container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="course-sidebar">
                    <div class="sidebar-title course-lesson">
                        <h2 id="course_title"><?php the_title() ?></h2>
                    </div>
                    <div class="panel-group" id="accordion">

                        <?php
                        foreach ($chapters as $chapter){
                            $id = $chapter['course-chapter'];
                            $title = $chapter['chapter-title'];
                            $post = get_post($id);
                            require(locate_template('course-panel.php'));
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="main-content">
                <h2 class="course-video text-info" id="course_content_title">
                    <?php _e("Please Select a Content from the Chapters","mt_admin") ?>
                </h2>

                <div id="vplayer" style="width:100%;"></div>
                <div id="yplayer" style="width:100%;"></div>
                <div class="course_content" id="course_content_body">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php endif ?>
<?php $mt_course_nonce = wp_create_nonce('mt_course_nonce'); ?>
    <script type="text/javascript">
        /* <![CDATA[ */
        var mt_course_nonce="<?php echo $mt_course_nonce?>";
        /* ]]> */
    </script>
<?php get_footer('course') ?>
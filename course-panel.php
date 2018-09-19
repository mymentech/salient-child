<div class="panel panel-default">
    <div class="panel-heading">
        <h4>
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#<?php echo esc_html($post->post_name) ?>">
                <?php echo esc_html($title) ?>
            </a>
        </h4>
    </div>
    <div id="<?php echo esc_html($post->post_name) ?>" class="panel-collapse collapse in">
        <ul class="list-unstyled">
            <?php
            $course_contents = get_post_meta($id,'chapter-data',true);
            $course_contents = $course_contents['content-group'];
            $course_contents_ids = array();


            foreach ($course_contents as $content){
                if($content['chapter-content']){
                    $content = array_values($content)[1];
                    $course_contents_ids[] = $content;
                }
            }

            $course_contents_ids = array_unique($course_contents_ids);

            $the_query = new WP_Query( array(
                'post_type' => 'course-contents',
                'post__in'      => $course_contents_ids,
//                'meta_query' => array(
//                    'post__in'      => $course_contents_ids
//                )


            ) );

            while ( $the_query->have_posts() ) :
                $the_query->the_post();

                $content_meta = get_post_meta(get_the_ID(),'course-meta',true);
                if($content_meta['video-check']){
                    $video_duration = $content_meta["video-duration"];
                    $video_type = $content_meta["video-type"];
                    if('youtube'==$video_type){
                        $data_type = '';
                        $vid = $content_meta['youtube-video'];
                    }else if('vimeo'==$video_type){
                        $data_type = '1';
                        $vid = $content_meta['vimeo-video'];
                    }

                }else{
                    $data_type = '';
                    $vid = '';
                }

                ?>

                <li>
                    <a href="#" data-vid="<?php echo esc_attr($vid) ?>" data-type="<?php echo esc_attr($data_type) ?>" data-post="<?php the_ID() ?>" data-title="<?php the_title() ?>" class="course_content_link">
                        <i class="fa fa-plus"></i>
                        <?php the_title() ?>
                        <span class="badge badge-warning badge-pill pull-right">
                            <?php if(isset($video_duration)&&$video_duration!='')echo esc_html($video_duration) ?>
                        </span>
                    </a>
                </li>
            <?php




            endwhile;

            wp_reset_postdata();


            ?>





        </ul>
    </div>
</div>
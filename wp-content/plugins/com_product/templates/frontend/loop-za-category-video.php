<?php
                if($the_query->have_posts()){
                    ?>
                    <div class="category-videos-box-842823">
                        <?php
                        while ($the_query->have_posts()){
                            $the_query->the_post();
                            $post_id=$the_query->post->ID;
                            $title=get_the_title($post_id);
                            $video_id=get_field("video_id",@$post_id);
                            $featured_img=get_the_post_thumbnail_url($post_id, 'full');
                            $date_post=get_the_date('l , j F , Y',@$post_id);
                            ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="video-item-box">
                                        <div class="video-pin-box">
                                            <a href="javascript:void(0);" class="js-modal-btn" data-video-id="<?php echo @$video_id; ?>">
                                                <div style="background-image: url('<?php echo @$featured_img; ?>');background-size: cover;background-repeat: no-repeat;padding-top: calc(100% / (359/199));">

                                                </div>
                                                <div class="overlay-youtube">
                                                </div>
                                                <div class="youtube-icon">
                                                    <img src="<?php echo wp_get_upload_dir()["url"].'/youtube-icon.png'; ?>">
                                                </div>
                                            </a>
                                        </div>
                                        <div class="video-right-box">
                                            <h3 class="video-item-title"><a href="javascript:void(0);" class="js-modal-btn" data-video-id="<?php echo @$video_id; ?>"><?php echo @$title; ?></a></h3>
                                            <div class="ngay-dang">Ngày đăng : <?php echo @$date_post; ?></div>
                                        </div>
                                        <div class="clr"></div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                    <?php
                }
                echo @$pagination->showPagination();
                ?>
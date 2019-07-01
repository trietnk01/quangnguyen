<?php
$args = array(
    'post_type' => 'post',
    'orderby' => 'id',
    'order'   => 'DESC',
    'posts_per_page' => 6,
);
$the_query_tai_lieu_moi=new WP_Query($args);
if($the_query_tai_lieu_moi->have_posts()){
    ?>
    <h3 class="ceo-name margin-top-40">Tài liệu mới</h3>
    <hr class="draw-line-right">
    <ul class="post-featured-list">
        <?php
        while ($the_query_tai_lieu_moi->have_posts()) {
            $the_query_tai_lieu_moi->the_post();
            $post_id=$the_query_tai_lieu_moi->post->ID;
            $permalink=get_the_permalink(@$post_id);
            $title=get_the_title(@$post_id);
            $excerpt=get_the_excerpt(@$post_id);
            $featured_img=get_the_post_thumbnail_url(@$post_id, 'full');
            $date_post=get_the_date( 'd/m/Y', @$post_id );
            ?>
            <li>
                <a href="<?php echo @$permalink; ?>">
                    <?php echo @$title; ?>
                </a>
            </li>
            <?php
        }
        wp_reset_postdata();
        ?>
    </ul>
    <?php
}
?>
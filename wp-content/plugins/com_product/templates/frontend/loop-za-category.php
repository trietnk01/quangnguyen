<?php
if($the_query_product->have_posts()){
    ?>
    <div class="za-category-wrapper">
        <?php
        $k=0;
        while($the_query_product->have_posts()) {
            $the_query_product->the_post();
            $post_id=$the_query_product->post->ID;
            $permalink=get_the_permalink(@$post_id);
            $title=get_the_title(@$post_id);
            $excerpt=get_the_excerpt(@$post_id);
            $featured_img=get_the_post_thumbnail_url(@$post_id, 'full');
            $product_price=get_field("zaproduct_price",@$post_id);
            $product_price_desc_percent=get_field("zaproduct_price_desc_percent",@$post_id);
            $product_sale_price=get_field("zaproduct_sale_price",@$post_id);
            $product_count_view=get_field("zaproduct_count_view",@$post_id);
            $product_so_tien_dong_gop=get_field("zaproduct_so_tien_dong_gop",@$post_id);
            if($k%3==0){
                echo '<div class="row">';
            }
            ?>
            <div class="col-sm-4">
                <div class="sale-off-on-day-box-item">
                    <div class="sale-off-box-hinh-tron">
                        <a href="<?php echo @$permalink; ?>">
                            <img src="<?php echo @$featured_img; ?>" alt="<?php echo @$title; ?>" style="width:150px;">
                        </a>
                        <?php
                        if(floatval(@$product_price_desc_percent) > 0){
                            ?>
                            <div class="sale-off-box">
                                <div class="sale-off-txt">Sale off</div>
                                <div class="sale-off-number"><?php echo floatval(@$product_price_desc_percent) ; ?>%</div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <h2 class="sale-off-on-day-title">
                        <a href="<?php echo @$permalink; ?>"><?php echo wp_trim_words(@$title,55, "[...]" ) ?></a>
                        <div class="post-kk-star-rating">
                            <?php echo do_shortcode( "[ratings]" ); ?>
                        </div>
                    </h2>
                    <div class="sale-off-on-day-price">
                        <span class="sale-off-on-day-sale-price"><?php echo fnPrice(@$product_sale_price) ; ?> ₫</span>
                        <?php
                        if(floatval(@$product_price) > floatval(@$product_sale_price)){
                            ?>
                            <span class="sale-off-on-day-sale-original-price"><?php echo fnPrice(@$product_price); ?> ₫</span>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                    if(floatval(@$product_so_tien_dong_gop) > 0){
                        ?>
                        <div class="mua-san-pham">
                            Mua sản phẩm này bạn đã đóng góp <?php echo fnPrice(@$product_so_tien_dong_gop); ?> đ vào quỹ tiếp lửa
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
            $k++;
            if($k%3==0 || $k==$the_query_product->post_count){
                echo '</div>';
            }
        }
        wp_reset_postdata();
        ?>
    </div>
    <div>
        <?php echo @$pagination->showPagination(); ?>
    </div>
    <?php
}else{
    ?>
    <div class="text-center margin-top-15">Đang cập nhật</div>
    <?php
}
?>
<?php
/*

Footer template

*/
$current_date= date("Y-m-d H:i:s",time());
$current_date_parse=date_parse_from_format("Y-m-d H:i:s",$current_date);
?>
<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 lalaborder">
        <div class="thoi-gian">&copy; 2013 - <?php echo @$current_date_parse['year']; ?> <?php echo get_bloginfo( 'name', 'raw' ); ?></div>
        <div class="footer-excerpt-info">
          <?php echo get_field("ft_slogan","option"); ?>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="ttlh-box">
          <h3 class="ttlh">Thông tin liên hệ</h3>
          <div class="para">
            <span class="email-xo"><i class="far fa-envelope"></i></span>
            <span class="email-txt"><a href="mailto:<?php echo get_field("setting_thong_tin_chung_email","option"); ?>"><?php echo get_field("setting_thong_tin_chung_email","option"); ?></a></span>
          </div>
          <div class="para">
            <span class="email-xo"><i class="fas fa-mobile-alt"></i></span>
            <span class="email-txt"><a href="tel:<?php echo get_field("setting_thong_tin_chung_call_now","option"); ?>"><?php echo get_field("setting_thong_tin_chung_hotline","option"); ?></a></span>
          </div>
          <div class="para">
            <span class="email-xo"><i class="fab fa-facebook-square"></i></span>
            <span class="email-txt"><a href="<?php echo get_field("setting_thong_tin_chung_facebook","option"); ?>">Facebook</a></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- begin pan search -->
<div class="pan_search">
  <div class="pan_close">
   <a href="javascript:void(0);" onclick="closeFrmSearch();"><i class="fa fa-times" aria-hidden="true"></i></a>
 </div>
 <form class="frmsearcharticle" name="frm_search_article" method="POST">
  <div class="vatimkiem"><input value="" name="s" type="search" placeholder="Tìm kiếm" class="txt_search" autocomplete="off"></div>
  <div class="btnsearch">
    <a href="javascript:void(0);" onclick="document.forms['frm_search_article'].submit();"><img src="<?php echo get_template_directory_uri()."/assets/images/search-w.svg"; ?>" /></a>
  </div>
</form>
</div>
<!-- end pan search -->
<!-- begin modal cart -->
<div class="modal fade modal-add-cart" id="modal-alert-add-cart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="com-product-modal-title">Thông báo</div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">

      </div>
    </div>
  </div>
</div>
<!-- end modal cart -->
<!-- begin scrolltop -->
<div class="scrollTop">
  <a href="javascript:void(0);"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
</div>
<!-- end scrolltop -->
<?php
wp_footer();
?>
</body>
</html>

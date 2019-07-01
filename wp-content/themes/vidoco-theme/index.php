<?php
/*
	Home template default
*/
	get_header();
	?>
	<h1 style="display: none;"><?php echo bloginfo( "name" ); ?></h1>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="box-info-left">
                    <div>
                        <img src="<?php echo get_field("hp_featured_banner","option"); ?>" alt="<?php echo get_field("hp_title","option"); ?>">
                    </div>
                    <h2 class="welcome-to"><?php echo get_field("hp_title","option"); ?></h2>
                    <hr class="draw-line">
                    <div class="box-excerpt-info">
                        <?php echo get_field("hp_about_us","option"); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="box-info-right">
                    <?php include get_template_directory()."/block/block-ceo.php"; ?>
                    <?php include get_template_directory()."/block/block-tai-lieu-moi.php"; ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    get_footer();
    ?>
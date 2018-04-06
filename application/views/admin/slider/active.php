<h1 class="my-4 text-center text-lg-left">Active Slider Gallery</h1>
<div class="row text-center text-lg-left">
    <?php
    foreach (glob('images/slider/*.*') as $file) {
        if (strpos($file, 'svg') == FALSE) {
            ?>
            <div class="col-lg-3 col-md-4 col-xs-6">
                <!--<a href="<?php echo base_url(); ?>admin/slider/edit/<?php // echo basename($file, ".jpg"); ?>" class="d-block mb-4 h-100">-->
                    <img class="img-fluid img-thumbnail" src="<?php echo base_url() . $file; ?>" alt="">
                <!--</a>-->
            </div>
            <?php
        }
    }
    ?>
</div>
<!--separator-->
<div style="height:20px;"></div>

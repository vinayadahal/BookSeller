<h1 class="my-4 text-center text-lg-left">Slider Gallery</h1>
<div style="margin-bottom: 10px; display: table;width: 100%;">
    <a href="<?php echo base_url(); ?>admin/slider/activeSlider" style="float:left;display: table-cell;"><button class="btn btn-default btn-primary" >Active Slider Images</button></a>
    <a href="<?php echo base_url(); ?>admin/slider/addSliderImage" style="float:right;display: table-cell;"><button class="btn btn-default btn-success" >Upload Image</button></a>
</div>
<div class="row text-center text-lg-left">
    <?php
    foreach (glob('images/uploads/*.*') as $file) {
        if (strpos($file, 'jpg') == TRUE) {
            ?>
            <div class="col-lg-3 col-md-4 col-xs-6">
                <a href="<?php echo base_url(); ?>admin/slider/edit/<?php echo basename($file, ".jpg"); ?>" class="d-block mb-4 h-100">
                    <img class="img-fluid img-thumbnail" src="<?php echo base_url() . $file; ?>" alt="<?php echo basename($file, ".jpg"); ?>" />
                </a>
            </div>
            <?php
        }
    }
    ?>
</div>
<!--separator-->
<div style="height:20px;"></div>
<!--<div class="admin_edit_center">-->
<div style="border: 1px solid black;width: 982px; float: left; display: table-cell; margin-right: 20px;"><img src="<?php echo base_url() . $image_location; ?>" id="cropbox" style="width: 980px;" /></div>
<h4>Tips:</h4>
<ol>
    <li>Click on the image.</li>
    <li>Adjust the selection box UP or DOWN.</li>
    <li>Click on <b>Crop & Save</b>.</li>
</ol>
<h4>Trouble cropping?</h4>
Try resizing image before uploading.
<form action="<?php echo base_url() ?>admin/slider/cropUploadImage/" method="post" onsubmit="return checkCoords();">
    <input type="hidden" name="imgPath" value="<?php echo $image_location; ?>" />
    <input type="hidden" id="x" name="x" />
    <input type="hidden" id="y" name="y" />
    <input type="hidden" id="w" name="w" />
    <input type="hidden" id="h" name="h" />
    <input type="submit" value="Crop & Save" class="btn btn-default btn-success" style="margin-top: 10px;"/>
</form>
<a href="<?php echo base_url(); ?>admin/slider/deleteImage/<?php echo basename($image_location, '.jpg') ?>/" onclick="return confirm('Are you sure to delete the image?')"><button class="btn btn-default btn-danger" style="margin-top: 10px;">Delete Image</button></a>
<script type="text/javascript">
    $(function () {
        $('#cropbox').Jcrop({
            aspectRatio: 0,
            onSelect: updateCoords,
            minSize: [980, 350],
            maxSize: [980, 350]
        });
//        imageSize();
    });
    function updateCoords(c) {
        $('#x').val(c.x);
        $('#y').val(c.y);
        $('#w').val(c.w);
        $('#h').val(c.h);
    }
    function checkCoords() {
        if (parseInt($('#w').val()))
            return true;
        alert('Please select a crop region then press submit.');
        return false;
    }
//    function imageSize() {
//        var height = $('#cropbox').height();
//        if (height >= 500) {
//            $('#footerAdmin').attr('class', 'footerNormal');
//        } else {
//            $('#footerAdmin').attr('class', 'navbar navbar-default navbar-fixed-bottom');
//        }
//    }
</script>
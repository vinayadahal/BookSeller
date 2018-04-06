<div class="list_details_wrap">
    <h3>Upload Image</h3>
    <div class="form_wrap">
        <form method="post" action="<?php echo base_url() ?>admin/slider/uploadSliderImage" enctype="multipart/form-data">
            <table border="0">
                <tr>
                    <td>Image Preview:</td>

                <tr/>
                <tr>
                    <td><img id='imgLocation' class='productImgLarge' style="margin-bottom: 10px;"></td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group">
                            <span class="btn btn-default btn-file">Browse <input type="file" name="imgFile" id="img" /></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button type="submit" class="btn btn-success">Add</button>
                        <a href="<?php echo base_url(); ?>admin/slider"><button type="button" class="btn btn-danger">Cancel</button></a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
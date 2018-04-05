<div class="list_details_wrap">
    <h3>Edit Category</h3>
    <div class="form_wrap">
        <form method="post" action="<?php echo base_url() ?>admin/category/update">
            <input type="hidden" value="<?php echo $category_id; ?>" name="category_id" />
            <table border="0">
                <tr>
                    <td>Name:</td>
                    <td><input type="text" value="<?php echo $category['name']; ?>" class="form-control" name="name" /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="<?php echo base_url(); ?>admin/category"><button type="button" class="btn btn-danger">Cancel</button></a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
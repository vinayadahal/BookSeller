<div class="list_details_wrap">
    <h3>Add Category</h3>
    <div class="form_wrap">
        <form method="post" action="<?php echo base_url() ?>admin/category/create" onsubmit="return validate(['name'])">
            <table border="0">
                <tr>
                    <td>Name:</td>
                    <td><input type="text" class="form-control" name="name" id='name'/></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success">Add</button>
                        <a href="<?php echo base_url(); ?>admin/category"><button type="button" class="btn btn-danger">Cancel</button></a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<div class="list_details_wrap">
    <h3>Add Post</h3>
    <div class="form_wrap">
        <form method="post" action="<?php echo base_url() ?>member/my-posts/create">
            <table border="0">
                <tr>
                    <td>Book Name:</td>
                    <td><input type="text" class="form-control" name="book_name" /></td>
                </tr>
                <tr>
                    <td>Author:</td>
                    <td><input type="text" class="form-control" name="author" /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success">Add</button>
                        <a href="<?php echo base_url(); ?>member/my-posts"><button type="button" class="btn btn-danger">Cancel</button></a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
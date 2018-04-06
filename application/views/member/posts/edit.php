<div class="list_details_wrap">
    <h3>Edit Post</h3>
    <div class="form_wrap">
        <form method="post" action="<?php echo base_url() ?>member/my-posts/update" onsubmit="return validate(['book_name', 'author'])">
            <input type="hidden" value="<?php echo $post_id; ?>" name="post_id" />
            <table border="0">
                <tr>
                    <td>Book Name:</td>
                    <td><input type="text" value="<?php echo $post['book_name']; ?>" class="form-control" name="book_name" id='book_name' /></td>
                </tr>
                <tr>
                    <td>Author:</td>
                    <td><input type="text" value="<?php echo $post['author']; ?>" class="form-control" name="author" id='author'/></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="<?php echo base_url(); ?>member/my-books"><button type="button" class="btn btn-danger">Cancel</button></a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
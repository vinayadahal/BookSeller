<div class="list_details_wrap">
    <div>
        <a href="<?php echo base_url() ?>member/my-posts/add">
            <button type="button" class="btn btn-success" style="float: right;display: table-cell;">Add New</button>
        </a>
    </div>
    <h3>My Posts</h3>
    <div class="list_details">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Book Name</th>
                    <th scope="col">Author</th>
                    <th scope="col" colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($AllPosts as $post) {
                    ?>
                    <tr>
                        <th scope="row">
                            <?php
                            if (!empty($data_count)) {
                                echo $data_count++;
                            } else {
                                echo $i++;
                            }
                            ?>
                        </th>
                        <td><?php echo $post->book_name; ?></td>
                        <td><?php echo $post->author; ?></td>
                        <td><a href="<?php echo base_url() ?>member/my-posts/edit/<?php echo $post->id; ?>">Edit</a></td>
                        <td><a onclick="return confirm('Are you sure to delete <?php echo $post->book_name; ?>?')" href="<?php echo base_url() ?>member/my-posts/delete/<?php echo $post->id; ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="pagination_wrap">
    <ul class="pagination">
        <li>
            <a href="<?php echo base_url(); ?>member/my-posts/<?php echo 1; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <?php for ($i = 1; $i <= $num_pages; $i++) { ?>
            <li><a href="<?php echo base_url(); ?>member/my-posts/<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php } ?>
        <li>
            <a href="<?php echo base_url(); ?>member/my-posts/<?php echo --$i; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</div>
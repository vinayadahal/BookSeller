<div class="list_details_wrap">
    <h3>User's Request</h3>
    <div class="list_details">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Book Name</th>
                    <th scope="col">Author</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
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
                        <td><?php echo $post['book_name']; ?></td>
                        <td><?php echo $post['author']; ?></td>
                        <td><?php echo $post['username']; ?></td>
                        <td><?php echo $post['email']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


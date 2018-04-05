<div class="list_details_wrap">
    <h3>Matching Books</h3>
    <div class="list_details">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Book Name</th>
                    <th scope="col">Author</th>
                    <th scope="col">Year</th>
                    <th scope="col">Edition</th>
                    <th scope="col">Offer</th>
                    <th scope="col">Price</th>
                    <th scope="col">Pages</th>
                    <th scope="col">Condition</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($AllBooks as $book) {
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
                        <td><?php echo $book['name']; ?></td>
                        <td><?php echo $book['author']; ?></td>
                        <td><?php echo date('Y', strtotime($book['year'])); ?></td>
                        <td><?php echo $book['edition']; ?></td>
                        <td><?php echo $book['offer']; ?></td>
                        <td>Rs. <?php echo $book['price']; ?> /-</td>
                        <td><?php echo $book['pages']; ?></td>
                        <td><?php echo $book['condition']; ?></td>
                        <td><a href="<?php echo base_url() ?>showDetails/<?php echo $book['id']; ?>" target="_blank">View</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
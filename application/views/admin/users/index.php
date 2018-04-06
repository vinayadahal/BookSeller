<div class="list_details_wrap">
    <div>
        <a href="<?php echo base_url() ?>admin/users/add">
            <button type="button" class="btn btn-success" style="float: right;display: table-cell;">Add New</button>
        </a>
    </div>
    <h3>All Users</h3>
    <div class="list_details">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">Created</th>
                    <th scope="col">Role</th>
                    <th scope="col">Username</th>
                    <th scope="col" colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($users as $user) {
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
                        <td><?php echo ucwords($user->name); ?></td>
                        <td><?php echo $user->email; ?></td>
                        <td><?php echo $user->phone; ?></td>
                        <td><?php echo ucwords($user->address); ?></td>
                        <td><?php echo date('Y-m-d', strtotime($user->created)); ?></td>
                        <td><?php echo $user->role; ?></td>
                        <td><?php echo $user->username; ?></td>
                        <td><a href="<?php echo base_url() ?>admin/users/edit/<?php echo $user->id; ?>">Edit</a></td>
                        <td><a onclick="return confirm('Are you sure to delete <?php echo $user->name; ?>?')" href="<?php echo base_url() ?>admin/users/delete/<?php echo $user->id; ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
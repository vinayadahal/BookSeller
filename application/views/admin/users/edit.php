<div class="list_details_wrap">
    <h3>Edit User</h3>
    <div class="form_wrap">
        <form method="post" action="<?php echo base_url() ?>admin/users/update" onsubmit="return validate(['name', 'email', 'phone', 'address', 'role', 'username', 'password', 'con_password'])">
            <input type="hidden" value="<?php echo $user_id;?>" name='user_id'/>
            <table border="0">
                <tr>
                    <td>Name:</td>
                    <td><input type="text" class="form-control" name="name" id='name' value="<?php echo $users['name']; ?>" /></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="text" class="form-control" name="email" id='email' value="<?php echo $users['email']; ?>"/></td>
                </tr>
                <tr>
                    <td>Phone:</td>
                    <td><input type="text" class="form-control" name="phone" id='phone' value="<?php echo $users['phone']; ?>"/></td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td><input type="text" class="form-control" name="address" id='address' value="<?php echo $users['address']; ?>"/></td>
                </tr>
                <tr>
                    <td>Role:</td>
                    <td>
                        <select class="form-control" name="role">
                            <?php
                            foreach ($roles as $role) {
                                if ($role->role == $users['role']) {
                                    ?>
                                    <option selected="selected" value="<?php echo $role->id; ?>"><?php echo $role->role; ?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $role->id; ?>"><?php echo $role->role; ?></option>
                                <?php }
                            } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" class="form-control" name="username" id='username' value="<?php echo $users['username']; ?>"/></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" class="form-control" name="password"/></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" class="form-control" name="con_password"/></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="<?php echo base_url(); ?>admin/users"><button type="button" class="btn btn-danger">Cancel</button></a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
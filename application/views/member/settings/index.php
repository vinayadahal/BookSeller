<div class="list_details_wrap">
    <h3>Change Credentials</h3>
    <div class="form_wrap">
        <form method="post" action="<?php echo base_url() ?>member/settings/updateUser">
            <table border="0">
                <tr>
                    <td>Username:</td>
                    <td><input type="text" class="form-control" name="username" value="<?php echo $user->username; ?>" /></td>
                </tr>
                <tr>
                    <td>Old Password:</td>
                    <td><input type="password" class="form-control" name="old_password" /></td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" class="form-control" name="new_password" /></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" class="form-control" name="con_password" /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="<?php echo base_url(); ?>member"><button type="button" class="btn btn-danger">Cancel</button></a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<h3>Please Provide Your Information</h3>
<div class="form_wrap">
    <form method="post" action="<?php echo base_url() ?>signup" onsubmit="return validate(['name', 'email', 'phone', 'address', 'username', 'password', 'con_password'])">
        <table border="0">
            <tr>
                <td>Name:</td>
                <td><input type="text" class="form-control" name="name" id='name' /></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="text" class="form-control" name="email" id='email'/></td>
            </tr>
            <tr>
                <td>Phone:</td>
                <td><input type="text" class="form-control" name="phone" id='phone' /></td>
            </tr>
            <tr>
                <td>Address:</td>
                <td><input type="text" class="form-control" name="address" id='address'/></td>
            </tr>
            <tr>
                <td>Username:</td>
                <td><input type="text" class="form-control" name="username" id='username'/></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" class="form-control" name="password" id='password'/></td>
            </tr>
            <tr>
                <td>Confirm Password:</td>
                <td><input type="password" class="form-control" name="con_password" id='con_password'/></td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit" class="btn btn-success">Register</button></td>
            </tr>
        </table>
    </form>
</div>
<div style='height:20px;'></div>
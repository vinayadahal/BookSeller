<div class="container" id="container">
    <div class="panel panel_login">
        <div class="headings">
            Login - Book Deals
        </div>
        <div class="input_wrap">
            <form action="<?php echo base_url(); ?>checkLogin" method="POST">
                <div class="inner-addon left-addon">
                    <input type="text" class="form-control form_override" name="username" placeholder="Username"/>
                </div>
                <div class="inner-addon left-addon">
                    <input type="password" class="form-control form_override" name="password" placeholder="Password"/>
                </div>
                <button type="submit" class="btn btn-success btn_login_override">Login</button>
            </form>
        </div>
    </div>
</div>
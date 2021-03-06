</div><!--container close-->
<?php
if (isset($AllBooks)) {
    ?>
    <div class="pagination_wrap">
        <hr />
        <ul class="pagination">
            <li>
                <a href="<?php echo base_url(); ?>member/my-books/<?php echo 1; ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php for ($i = 1; $i <= $num_pages; $i++) { ?>
                <li><a href="<?php echo base_url(); ?>home/<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php } ?>
            <li>
                <a href="<?php echo base_url(); ?>member/my-books/<?php echo --$i; ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </div>
<?php } ?>

<script type="text/javascript" src="<?php echo base_url(); ?>js/script.js"></script>

<div class="footerWrap" id="footerWrap">
    <div class="footerLinkWrap">
        <div class="footerLink">
            <!--<img src="<?php echo base_url(); ?>images/logo.png" width="200" />-->
            <i class="fa fa-book fa-5x"></i>

            <br />
            <br />
            <?php
            $copyright = "© Copyright 2018 Book Deals. All Rights Reseverd. Privacy and Policy.";
            if (!empty($copyright)) {
                echo $copyright;
            }
            ?>
        </div>
        <div class="footerLink">
            <ul>
                <li><h4>This Site</h4></li>
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="<?php echo base_url() ?>register">Register</a></li>
                <li><a href="<?php echo base_url(); ?>request">User's Request</a></li>
            </ul>
        </div>
        <div class="footerLink">
            <ul>
                <li><h4>My Account</h4></li>
                <?php if (empty($user_id) && !isset($user_id)) { ?>
                    <li><a href="<?php echo base_url() ?>login">Login</a></li>
                <?php } ?>
                <li><a href="<?php echo base_url() ?>member/my-books">My Books</a></li>
                <li><a href="<?php echo base_url() ?>member/my-posts" >My Posts</a></li>
                <li><a href="<?php echo base_url() ?>member/matches">Matching Books</a></li>
            </ul>
        </div>
        <div class="footerLink">
            <ul>
                <li><h4>Customer Service</h4></li>
                <li><a href="javascript:void(0)" onclick="loadForm('Suggestion');">Return Policy</a></li>
                <li><a href="javascript:void(0)" onclick="loadForm('Suggestion');">Privacy & Security</a></li>
                <li><a href="javascript:void(0)" onclick="loadForm('Suggestion');">Suggestion</a></li>
                <li><a href="javascript:void(0)" onclick="loadForm('Feedback');">Feedback</a></li>
            </ul>
        </div>
        <div class="footerLink">
            <ul>
                <li><h4>Follow us</h4></li>
                <li><a href="https://www.facebook.com/"><span class="footerIcon fb">Facebook</span></a></li>
                <li><a href="https://twitter.com/"><span class="footerIcon tw">Twitter</span></a></li>
                <li><a href="https://plus.google.com/"><span class="footerIcon gp">Google +</span></a></li>
                <li><a href="https://www.linkedin.com/"><span class="footerIcon in">Linked In</span></a></li>
            </ul>
        </div>
    </div>
</div>
<script type="text/javascript">
    showPopup();
</script>
</body>
</html>
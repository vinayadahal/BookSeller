<div class="dashboard_wrap">
    <div class="dashboard_icons_wrap">
        <a href="<?php echo base_url(); ?>member/my-books">
            <div class="dashboard_icons"><i class="fa fa-book" style="font-size: 128px;"></i>My Books</div>
        </a>
        <a href="<?php echo base_url(); ?>member/my-posts">
            <div class="dashboard_icons"><i class="fa fa-comments" style="font-size: 128px;"></i>My Posts</div>
        </a>
        <a href="<?php echo base_url(); ?>member/matches">
            <div class="dashboard_icons">
                <i class="fa fa-copy" style="font-size: 128px;"></i>Matching Books <?php
                if (!empty($books)) {
                    $count = 0;
                    foreach ($books as $book) {
                        $count += count($book);
                    }
                    echo "<span>(" . $count . ")</span>";
                }
                ?>
            </div>
        </a>
        <a href="<?php echo base_url(); ?>member/settings">
            <div class="dashboard_icons"><i class="fa fa-cog" style="font-size: 128px;"></i>Settings</div>
        </a>
    </div>
</div>
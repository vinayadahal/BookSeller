<div class="showDetailsWrap">
    <div class="breadcrumb">
        <a href="<?php echo base_url(); ?>">Home</a> > <?php echo $title; ?>
    </div>

    <div class="showDetailsImage">
        <img src="<?php echo base_url(); ?>images/icons/1.jpg" alt="item image"/>
    </div>
    <div class="showDetailsItem">
        <h3><?php echo $book_category['name']; ?></h3>
        <hr/>
        <div class="showDetailsBtnWrap">
            <a href="javascript:void(0);" onclick="showOverView();"><div class="showDetailsBtn">Overview</div></a>
            <a href="javascript:void(0);" onclick="showReview();"><div class="showDetailsBtn">Review <span id="review_count"></span></div></a>
            <a href="javascript:void(0);" onclick="showBidding();"><div class="showDetailsBtn">Bidding <span id="bidding_count"></span></div></a>
        </div>

        <div class="item_details" id="overview">
            <table class="table">
                <thead>
                    <tr>
                        <td width="150"><h5>Book Title:</h5></td>
                        <td><h5><?php echo $book_category['name']; ?></h5></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="150"><h5>Author:</h5></td>
                        <td><h5><?php echo $book_category['author']; ?></h5></td>
                    </tr>
                    <tr>
                        <td width="150"><h5>Year:</h5></td>
                        <td><h5><?php echo date('Y', strtotime($book_category['year'])); ?></h5></td>
                    </tr>
                    <tr>
                        <td width="150"><h5>Edition:</h5></td>
                        <td><h5><?php echo $book_category['edition']; ?></h5></td>
                    </tr>
                    <tr>
                        <td width="150"><h5>Pages:</h5></td>
                        <td><h5><?php echo $book_category['pages']; ?></h5></td>
                    </tr>
                    <?php if (!empty($book_category['offer'])) { ?>
                        <tr>
                            <td width="150"><h5>Offer:</h5></td>
                            <td><h5><?php echo $book_category['offer']; ?></h5></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td width="150"><h5>Category:</h5></td>
                        <td><h5><?php echo $book_category['category_name']; ?></h5></td>
                    </tr>
                    <tr>
                        <td width="150"><h5>Condition:</h5></td>
                        <td><h5><?php echo $book_category['condition']; ?></h5></td>
                    </tr>
                    <tr>
                        <td width="150"><h5>Price:</h5></td>
                        <?php if (!empty($book_category['price'])) { ?>
                            <td><h5><?php echo "Rs. " . $book_category['price'] . " /-"; ?></h5></td>
                        <?php } else { ?>
                            <td><h5><?php echo "Free"; ?></h5></td>
                        <?php } ?>
                    </tr>

                </tbody>
            </table>
        </div>
        <div class="item_details" id="review">
            <div class="reviewWrap">
                <?php
                if (empty($reviews)) {
                    echo "No review for this book has been posted yet!";
                }
                foreach ($reviews as $review) {
                    ?>
                    <div class="reviewBox">
                        <h4><?php echo $review['title']; ?></h4>
                        <div class="review">
                            <?php echo $review['review']; ?>
                        </div>
                        <h6 style="text-align: right">
                            <b><?php echo $review['username']; ?></b>
                            <br><br>
                            Member Since: <?php echo date('M j, Y', strtotime($review['member_since'])); ?>
                        </h6>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="item_details" id="bidding">
            <div class="reviewWrap">
                <?php
                if (empty($biddings)) {
                    echo "No bidding for this book has been posted yet!";
                }
                foreach ($biddings as $bidding) {
                    ?>
                    <div class="reviewBox">
                        <h4>
                            <?php echo $bidding['username']; ?>
                        </h4>
                        <h6>Member Since: <?php echo date('M j, Y', strtotime($bidding['member_since'])); ?></h6>
                        <div class="review">
                            <?php echo $bidding['bidding']; ?>
                        </div>
                        <h6 style="text-align: right">- Posted On: <?php echo date('M j, Y H:i:s', strtotime($bidding['time'])); ?></h6>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="reviewBidWrap">

    <div class="reviewBidBox" >test</div>
    <div class="reviewBidBox" >test2</div>
</div>
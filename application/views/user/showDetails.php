<div class="showDetailsWrap">
    <div class="breadcrumb">
        <a href="<?php echo base_url(); ?>">Home</a> > <?php echo $title; ?>
    </div>

    <div class="showDetailsImage">
        <div id="image_main_preview">
            <?php if (!empty($images[0]->image_location)) { ?>
                <img src="<?php echo base_url().'images/icons/' . $images[0]->image_location; ?>" alt="item image"/>
                <?php
            } else {
                ?>
                <img src="<?php echo base_url(); ?>images/icons/default.png" alt="item image"/>
                <?php
            }
            ?>
        </div>
        <div class="images_wrapper"> <!--Max support for 8 images-->
            <?php
            if (count($images) > 1) {
                foreach ($images as $image) {
                    ?>
                    <div class="images_icons">
                        <img src="<?php echo base_url() . $image->image_location; ?>" alt="item image" style="width: 40px;" onclick="loadMainPreview(this);"/>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <div style="padding-top: 10px;font-size: 14px;">
            Posted By: <?php echo ucwords($book_category['username']); ?> <br/>
            Member Since: <?php echo date('M j, Y', strtotime($book_category['member_since'])); ?>
        </div>

    </div>
    <div class="showDetailsItem">
        <h3><?php echo $book_category['name']; ?></h3>
        <hr/>
        <div class="showDetailsBtnWrap">
            <a href="javascript:void(0);" onclick="showOverView();"><div class="showDetailsBtn">Overview</div></a>
            <?php if (!empty($descriptions)) { ?>
                <a href="javascript:void(0);" onclick="showDescription();"><div class="showDetailsBtn">Description</div></a>
            <?php } ?>
            <a href="javascript:void(0);" onclick="showReview();"><div class="showDetailsBtn">Review <span id="review_count"></span></div></a>
            <?php if ($book_category['condition'] != "Brand New" && !empty($book_category['price'])) { ?>
                <a href="javascript:void(0);" onclick="showBidding();"><div class="showDetailsBtn">Bidding <span id="bidding_count"></span></div></a>
            <?php } ?>
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
                        <h4>"<?php echo $review['title']; ?>"</h4>
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
                        <h4><?php echo $bidding['title']; ?></h4>
                        <div class="review">
                            <?php echo $bidding['bidding']; ?>
                        </div>
                        <h6 style="text-align: right">
                            <b><?php echo $bidding['username']; ?></b>
                            <br><br>
                            Member Since: <?php echo date('M j, Y', strtotime($review['member_since'])); ?>
                        </h6>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="item_details" id="description">
            <div class="reviewWrap">
                <?php foreach ($descriptions as $description) { ?>
                    <div class="reviewBox"><?php echo $description['description']; ?></div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="reviewBidWrap">
    <div class="reviewBidBox">
        <h4>Post A Review</h4>
        <form>
            <table class="table">
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="name" class="form-control" /></td>
                </tr>
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" class="form-control" /></td>
                </tr>
                <tr>
                    <td>Review:</td>
                    <td><textarea name="review" class="form-control"></textarea></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Post Your Review" class="btn btn-info" /></td>
                </tr>
            </table>
        </form>
    </div>
    <?php if ($book_category['condition'] != "Brand New" && !empty($book_category['price'])) { ?>
        <div class="reviewBidBox">
            <h4>Post A Bidding</h4>
            <form>
                <table class="table">
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="name" class="form-control" /></td>
                    </tr>
                    <tr>
                        <td>Review:</td>
                        <td><textarea name="review" class="form-control"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Post Your Bid" class="btn btn-info" /></td>
                    </tr>
                </table>
            </form>
        </div>
    <?php } ?>
</div>
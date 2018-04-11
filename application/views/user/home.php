<div class="search_area_dropdown">
    <span style="float: left"><h3 style="display: inline;">All Books</h3></span>
<!--    <span class="custom-dropdown">
        Sort By:
        <select>
            <option>Lowest Price</option>
            <option>Highest Price</option>
            <option>Newest Book</option>
            <option>Oldest Book</option>
            <option>For Share</option>
            <option>For Rent</option>
            <option>For Free</option>
        </select>
    </span>-->
</div>
<hr/>
<?php foreach ($AllBooks as $book) { ?>
    <div class="item col-lg-3">
        <div class="thumbnail" >
            <div class="caption ">
                <div class="thumbnail">
                    <?php if (!empty($book->image_location) && $book->image_location != "default.png") { ?>
                        <a href="<?php echo base_url(); ?>showDetails/<?php echo $book->id; ?>"><img src="<?php echo base_url(); ?>images/icons/<?php echo $book->image_location; ?>" alt="item image"></a>
                    <?php } else { ?>
                        <a href="<?php echo base_url(); ?>showDetails/<?php echo $book->id; ?>"><img src="<?php echo base_url(); ?>images/default/default.png" alt="item image"></a>
                    <?php } ?>
                </div>
                <div id="product_title" class="product_title">
                    <h4 class="list-group-item-heading">
                        <a href="<?php echo base_url(); ?>showDetails/<?php echo $book->id; ?>">
                            <?php
                            echo htmlspecialchars($book->name) . " - ";
                            if (!empty($book->edition)) {
                                echo htmlspecialchars($book->edition) . " Edition By ";
                            }
                            echo htmlspecialchars($book->author) . " ";
                            if (!empty($book->year)) {
                                echo "(" . htmlspecialchars(date('Y', strtotime($book->year))) . ") ";
                            }
                            ?>
                        </a>
                    </h4>
                </div>
                <div class="product_offer">
                    <?php if (!empty($book->offer)) { ?>
                        <i class="fa fa-info-circle"></i> <?php echo htmlspecialchars($book->offer); ?>
                    <?php } ?>
                </div>
                <div class="price_btn">
                    <p>
                        <?php
                        if (!empty($book->price)) {
                            echo "Rs. " . $book->price . " /-";
                        } else {
                            echo "Free";
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php
}

    
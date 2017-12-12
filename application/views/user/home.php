<h3>All Books</h3>
<hr/>
<div class="search_area">
    <input type="text" placeholder="Search..." class="form-control search_box"/>
    <button class="btn btn-default search_btn" type="submit">
        <i class="fa fa-search" ></i>
    </button>
</div>
<div class="search_area">
    <span class="custom-dropdown">
        Sort By:
        <select >
            <option>Lowest Price</option>
            <option>Highest Price</option>
            <option>Newest Book</option>
            <option>Oldest Book</option>
            <option>For Share</option>
            <option>For Rent</option>
        </select>
    </span>
</div>

<?php foreach ($AllBooks as $book) { ?>
    <div class="item col-lg-3">
        <div class="thumbnail" >
            <div class="caption ">
                <div class="thumbnail">
                    <a href="<?php echo base_url(); ?>showDetails/<?php echo $book->id; ?>"><img src="<?php echo base_url(); ?>images/icons/1.jpg" alt="item image"></a>
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


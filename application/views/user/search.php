<div class="search_area_dropdown">
    <span style="float: left"><h3 style="display: inline;">Search result for: <?php echo $keyword; ?></h3></span>
</div>
<hr/>
<?php
if (empty($searchBooks)) {
    echo "No result found for $keyword";
    echo "<div style='height:20px;'></div>";
} else {
    foreach ($searchBooks as $book) {
        ?>
        <div class="item col-lg-3">
            <div class="thumbnail" >
                <div class="caption ">
                    <div class="thumbnail">
                        <?php if (!empty($book['image_location'])) { ?>
                            <a href="<?php echo base_url(); ?>showDetails/<?php echo $book['id']; ?>"><img src="<?php echo base_url(); ?>images/icons/<?php echo $book['image_location']; ?>" alt="item image"></a>
                        <?php } else { ?>
                            <a href="<?php echo base_url(); ?>showDetails/<?php echo $book['id']; ?>"><img src="<?php echo base_url(); ?>images/icons/default.png" alt="item image"></a>
                        <?php } ?>
                    </div>
                    <div id="product_title" class="product_title">
                        <h4 class="list-group-item-heading">
                            <a href="<?php echo base_url(); ?>showDetails/<?php echo $book['id']; ?>">
                                <?php
                                echo htmlspecialchars($book['name']) . " - ";
                                if (!empty($book['edition'])) {
                                    echo htmlspecialchars($book['edition']) . " Edition By ";
                                }
                                echo htmlspecialchars($book['author']) . " ";
                                if (!empty($book['year'])) {
                                    echo "(" . htmlspecialchars(date('Y', strtotime($book['year']))) . ") ";
                                }
                                ?>
                            </a>
                        </h4>
                    </div>
                    <div class="product_offer">
                        <?php if (!empty($book['offer'])) { ?>
                            <i class="fa fa-info-circle"></i> <?php echo htmlspecialchars($book['offer']); ?>
                        <?php } ?>
                    </div>
                    <div class="price_btn">
                        <p>
                            <?php
                            if (!empty($book['price'])) {
                                echo "Rs. " . $book['price'] . " /-";
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
}

    
<!--<div-->
<h3>All Books</h3>
<hr/>
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
                    <!--<a class="btn btn-success" href="javascript:void(0);" onclick="hide_product('thumb<?php // echo $row["id"];                                    ?>')">Add To Cart</a>-->
                    <!--<a class="btn btn-info" style="float: right;" href="javascript:void(0);" onclick="hide_product('thumb<?php // echo $row["id"];                                    ?>')" >View Details</a>-->
                </div>
            </div>
        </div>
    </div>
<?php } ?>


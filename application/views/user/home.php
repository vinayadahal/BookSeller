<!--<div-->
<h3>All Books</h3>
<hr/>
<?php foreach ($AllBooks as $book) { ?>
    <div class="item col-lg-3">
        <div class="thumbnail" >
            <div class="caption ">
                <div class="thumbnail">
                    <img src="<?php echo base_url(); ?>images/icons/1.jpg" alt="item image">
                </div>
                <div id="product_title" class="product_title">
                    <h4 class="list-group-item-heading"><a href="#"><?php echo htmlspecialchars($book->name); ?></a></h4>
                </div>
                <div class="product_offer">
                    <?php if (!empty($book->offer)) { ?>
                        <i class="fa fa-info-circle"></i> <?php echo htmlspecialchars($book->offer); ?>
                    <?php } ?>
                </div>
                <div class="price_btn">
                    <p>Rs. <?php echo $book->price; ?> /-</p>
                    <!--<a class="btn btn-success" href="javascript:void(0);" onclick="hide_product('thumb<?php // echo $row["id"];           ?>')">Add To Cart</a>-->
                    <!--<a class="btn btn-info" style="float: right;" href="javascript:void(0);" onclick="hide_product('thumb<?php // echo $row["id"];           ?>')" >View Details</a>-->
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!--<div class="item col-lg-3">
    <div class="thumbnail" >
        <div class="caption ">
            <div class="thumbnail">
                <img src="<?php echo base_url(); ?>images/icons/2.jpg" alt="item image">
            </div>
            <div id="product_title" class="product_title">
                <h4 class="list-group-item-heading">BLA</h4>
            </div>
            <div class="product_offer">
<?php // if (!empty($row["offer"])) { ?>
                <i class="fa fa-info-circle"></i> bla
<?php // } ?>
            </div>
            <div class="price_btn">
                <p>Rs. <?php // echo $row["price"];           ?> /-</p>
                <a class="btn btn-success" href="javascript:void(0);" onclick="hide_product('thumb<?php // echo $row["id"];           ?>')">Add To Cart</a>
                <a class="btn btn-info" style="float: right;" href="javascript:void(0);" onclick="hide_product('thumb<?php // echo $row["id"];           ?>')" >View Details</a>
            </div>
        </div>
    </div>
</div>
<div class="item col-lg-3">
    <div class="thumbnail" >
        <div class="caption ">
            <div class="thumbnail">
                <img src="<?php echo base_url(); ?>images/icons/1.jpg" alt="item image">
            </div>
            <div id="product_title" class="product_title">
                <h4 class="list-group-item-heading">BLA</h4>
            </div>
            <div class="product_offer">
<?php // if (!empty($row["offer"])) { ?>
                <i class="fa fa-info-circle"></i> bla
<?php // } ?>
            </div>
            <div class="price_btn">
                <p>Rs. <?php // echo $row["price"];           ?> /-</p>
                <a class="btn btn-success" href="javascript:void(0);" onclick="hide_product('thumb<?php // echo $row["id"];           ?>')">Add To Cart</a>
                <a class="btn btn-info" style="float: right;" href="javascript:void(0);" onclick="hide_product('thumb<?php // echo $row["id"];           ?>')" >View Details</a>
            </div>
        </div>
    </div>
</div>
<div class="item col-lg-3">
    <div class="thumbnail" >
        <div class="caption ">
            <div class="thumbnail">
                <img src="<?php echo base_url(); ?>images/icons/1.jpg" alt="item image">
            </div>
            <div id="product_title" class="product_title">
                <h4 class="list-group-item-heading">BLA</h4>
            </div>
            <div class="product_offer">
<?php // if (!empty($row["offer"])) { ?>
                <i class="fa fa-info-circle"></i> bla
<?php // } ?>
            </div>
            <div class="price_btn">
                <p>Rs. <?php // echo $row["price"];           ?> /-</p>
                <a class="btn btn-success" href="javascript:void(0);" onclick="hide_product('thumb<?php // echo $row["id"];           ?>')">Add To Cart</a>
                <a class="btn btn-info" style="float: right;" href="javascript:void(0);" onclick="hide_product('thumb<?php // echo $row["id"];           ?>')" >View Details</a>
            </div>
        </div>
    </div>
</div>
<div class="item col-lg-3">
    <div class="thumbnail" >
        <div class="caption ">
            <div class="thumbnail">
                <img src="<?php echo base_url(); ?>images/icons/1.jpg" alt="item image">
            </div>
            <div id="product_title" class="product_title">
                <h4 class="list-group-item-heading">BLA</h4>
            </div>
            <div class="product_offer">
<?php // if (!empty($row["offer"])) { ?>
                <i class="fa fa-info-circle"></i> bla
<?php // } ?>
            </div>
            <div class="price_btn">
                <p>Rs. <?php // echo $row["price"];           ?> /-</p>
                <a class="btn btn-success" href="javascript:void(0);" onclick="hide_product('thumb<?php // echo $row["id"];           ?>')">Add To Cart</a>
                <a class="btn btn-info" style="float: right;" href="javascript:void(0);" onclick="hide_product('thumb<?php // echo $row["id"];           ?>')" >View Details</a>
            </div>
        </div>
    </div>
</div>
<div class="item col-lg-3">
    <div class="thumbnail" >
        <div class="caption ">
            <div class="thumbnail">
                <img src="<?php echo base_url(); ?>images/icons/1.jpg" alt="item image">
            </div>
            <div id="product_title" class="product_title">
                <h4 class="list-group-item-heading">BLA</h4>
            </div>
            <div class="product_offer">
<?php // if (!empty($row["offer"])) { ?>
                <i class="fa fa-info-circle"></i> bla
<?php // } ?>
            </div>
            <div class="price_btn">
                <p>Rs. <?php // echo $row["price"];           ?> /-</p>
                <a class="btn btn-success" href="javascript:void(0);" onclick="hide_product('thumb<?php // echo $row["id"];           ?>')">Add To Cart</a>
                <a class="btn btn-info" style="float: right;" href="javascript:void(0);" onclick="hide_product('thumb<?php // echo $row["id"];           ?>')" >View Details</a>
            </div>
        </div>
    </div>
</div>-->




<!--<div class="side_bar" id="side_bar">
    <ul>
        <a href="#"><li>Home</li></a>
        <a href="#"><li>Categories</li></a>
        <a href="#"><li>Reselled</li></a>
        <a href="#"><li>Shared</li></a>
    </ul>
</div>-->


<!--<div class="thumb_wrap">
    <div class="icons">
        <div class="preview">
            <img src="<?php echo base_url(); ?>images/icons/1.jpg"/>
        </div>
    </div>
    <div class="icons">
        <div class="preview">
            <img src="<?php echo base_url(); ?>images/icons/2.jpg"/>
        </div>
    </div>
    <div class="icons">
        <div class="preview">
            <img src="<?php echo base_url(); ?>images/icons/1.jpg"/>
    </div>
</div>-->
<!--</div>-->


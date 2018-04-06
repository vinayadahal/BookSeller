<div class="list_details_wrap">
    <h3>Add Book</h3>
    <div class="form_wrap">
        <form method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>member/my-books/create" onsubmit="return validate(['book_name', 'img', 'category', 'author', 'year', 'edition', 'pages','desc'])">
            <table border="0">
                <tr>
                    <td>Book Name:</td>
                    <td><input type="text" class="form-control" name="book_name" id='book_name' /></td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td>
                        <img id='imgLocation' class='productImg' style="margin-bottom: 10px;">
                        <div class="input-group">
                            <span class="btn btn-default btn-file">Browse <input type="file" name="imgFile" id="img" /></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select class="form-control" name="category" id='category'>
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Author:</td>
                    <td><input type="text" class="form-control" name="author" id='author'/></td>
                </tr>
                <tr>
                    <td>Year:</td>
                    <td><input type="text" class="form-control" name="year" id='year' placeholder="0000-00-00"/></td>
                </tr>
                <tr>
                    <td>Edition:</td>
                    <td><input type="text" class="form-control" name="edition" id='edition'/></td>
                </tr>
                <tr>
                    <td>Offer:</td>
                    <td><input type="text" class="form-control" name="offer" /></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="text" class="form-control" name="price" /></td>
                </tr>
                <tr>
                    <td>Pages:</td>
                    <td><input type="text" class="form-control" name="pages" id='pages'/></td>
                </tr>
                <tr>
                    <td>Condition:</td>
                    <td>
                        <select class="form-control" name="condition">
                            <option value="Brand New">Brand New</option>
                            <option value="Used">Used</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea class="form-control" name="description" rows="6" id="desc"></textarea></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success">Add</button>
                        <a href="<?php echo base_url(); ?>member/my-books"><button type="button" class="btn btn-danger">Cancel</button></a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
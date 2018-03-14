<div class="list_details_wrap">
    <h3>Add Book</h3>
    <div class="form_wrap">
        <form method="post" action="">
            <table border="0">
                <tr>
                    <td>Book Name:</td>
                    <td><input type="book_name" class="form-control" id="book_name"></td>
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
                        <select class="form-control" id="exampleFormControlSelect1">
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Author:</td>
                    <td><input type="author" class="form-control" id="author"></td>
                </tr>
                <tr>
                    <td>Year:</td>
                    <td><input type="year" class="form-control" id="year"></td>
                </tr>
                <tr>
                    <td>Edition:</td>
                    <td><input type="edition" class="form-control" id="edition"></td>
                </tr>
                <tr>
                    <td>Offer:</td>
                    <td><input type="offer" class="form-control" id="offer"></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="price" class="form-control" id="price"></td>
                </tr>
                <tr>
                    <td>Pages:</td>
                    <td><input type="pages" class="form-control" id="pages"></td>
                </tr>
                <tr>
                    <td>Condition:</td>
                    <td>
                        <select class="form-control">
                            <option value="Brand New">Brand New</option>
                            <option value="Used">Used</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea class="form-control" id="description" rows="6"></textarea></td>
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
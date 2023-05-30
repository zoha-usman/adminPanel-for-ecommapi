<?php
session_start();
include("conn.php");
include("header.php");
?>

<main>
    <div class="section-1">
        <div class="container text-center">
            <h1 class="heading-1">Add Product</h1>
            <!-- Add categories Page Data  -->
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <form name="frm" action="process-product.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Select Category</label><br/>
                            <select name="category" class="form-control">
                            <?php
                             $qry="select * from tbl_category";
                             $raw=mysqli_query($conn,$qry);
                            while($res=mysqli_fetch_array($raw)){
                            ?> 
                            <option value="<?php echo $res['catname']; ?>"><?php echo $res['catname']; ?></option>
                            <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Name</label>
                            <input type="text" name="pname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Product Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Thumbnail/Image</label>
                            <input type="file" name="upload" class="form-control" id="exampleInputPassword1" placeholder="product image">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Price </label>
                            <input type="text" name="price" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Product Price">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Stock </label>
                            <input type="text" name="stock" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Total Stock">
                        </div>
                        <div class="form-check">
                            <label for="exampleInputPassword1">Short Description</label>
                            <textarea name="sdesc" rows="5" cols="80" class="from-control"></textarea>
                        </div>
                        <br/>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                    <?php
                    if(isset($_SESSION['msg1'])) {
                        ?>
                        <div class="alert alert-success" role="alert">
                            <?php
                            echo $_SESSION['msg1'];
                            unset($_SESSION['msg1']);
                            ?>
                        </div>
                    <?php } ?>

                    <?php
                    if(isset($_SESSION['msg2'])) {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <?php
                            echo $_SESSION['msg2'];
                            unset($_SESSION['msg2']);
                            ?>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!-- end of Main section -->
        </div>
    </div>
</main>

<?php
include("footer.php");
?>

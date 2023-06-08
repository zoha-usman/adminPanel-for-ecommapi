<?php
session_start();
include("conn.php");
include("header.php");
?>

<main>
    <div class="section-1">
        <div class="container-fluid text-center">
            <h1 class="heading-1">Add Product</h1>
            <!-- Add categories Page Data  -->
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <?php include("manage_orders.php");
                    ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Address</th>
                                <th scope="col">Products</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $color_array = ['pending' => 'warning', 'accepted' => 'primary', 'delivered' => 'success', 'rejected' => 'danger'];
                            $result = mysqli_query($conn, "SELECT * FROM  tbl_orders");
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                                <tr>
                                    <td><?= $row['order_id'] ?></td>
                                    <td><?= $row['useremail'] ?></td>
                                    <td><?= $row['user_phone'] ?></td>
                                    <td><?= $row['useremail'] ?></td>
                                    <td><?= $row['user_address'] ?></td>
                                    <td><!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $row['order_id'] ?>">
                                            Show Products
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?= $row['order_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Products</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th>Products</th>
                                                                    <th scope="col">Size</th>
                                                                    <th scope="col">Quantity</th>
                                                                    <th class="text-center">Price</th>
                                                                    <th class="text-center">Sub Total</th>
                                                                    <th class="text-center">Date</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $product = mysqli_query($conn, "SELECT * FROM order_items WHERE order_id = $row[order_id]");
                                                                $i = 1;
                                                                while ($show_product = mysqli_fetch_array($product)) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?= $i ?></td>
                                                                        <td><?= $show_product['product_id'] ?></td>
                                                                        <td><?= $show_product['size'] ?></td>
                                                                        <td><?= $show_product['qty'] ?></td>
                                                                        <td><?= $show_product['price'] ?></td>
                                                                        <td><?= $show_product['sub_total'] ?></td>
                                                                        <td><?= $show_product['date'] ?></td>
                                                                    </tr>
                                                                <?php
                                                                    $i++;
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-pill badge-<?= $color_array[$row['order_status']] ?>"><?= $row['order_status'] ?></span>

                                    </td>
                                    <th class="text-center">
                                        <div class="btn-group" role="group" aria-label="...">
                                            <a href="?action=accept_order&order_id=<?= $row['order_id'] ?>"><button type="button" class="btn btn-primary">Accept</button></a>
                                            <a href="?action=reject_order&order_id=<?= $row['order_id'] ?>"> <button type="button" class="btn btn-danger">Reject</button></a>
                                            <a href="?action=delivered_order&order_id=<?= $row['order_id'] ?>"> <button type="button" class="btn btn-success">Delivered</button></a>
                                        </div>

                                    </th>

                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>

            <!-- end of Main section -->
        </div>
    </div>
</main>

<?php
include("footer.php");
?>
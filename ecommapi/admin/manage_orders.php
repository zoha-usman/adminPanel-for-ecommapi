<?php
include("../api/functions.php");
$conn = mysqli_connect("localhost", "root", "");
mysqli_select_db($conn, "ecommdb");

if (!empty($_REQUEST['action'])) {
    if (!empty($_REQUEST['action']) and $_REQUEST['action'] == "accept_order" and !empty($_REQUEST['order_id'])) {
        $order_data = [
            "order_status" => "accepted"
        ];
        if (update_data($conn, "tbl_orders", $order_data, "order_id", $_REQUEST['order_id'])) {
            echo "Status Update";
        }
    } elseif (!empty($_REQUEST['action']) and $_REQUEST['action'] == "reject_order" and !empty($_REQUEST['order_id'])) {
        $order_data = [
            "order_status" => "rejected"
        ];
        if (update_data($conn, "tbl_orders", $order_data, "order_id", $_REQUEST['order_id'])) {
            echo "Status Update";
        }
    } elseif (!empty($_REQUEST['action']) and $_REQUEST['action'] == "delivered_order" and !empty($_REQUEST['order_id'])) {
        $order_data = [
            "order_status" => "delivered"
        ];
        if (update_data($conn, "tbl_orders", $order_data, "order_id", $_REQUEST['order_id'])) {
            echo "Status Update";
        }
    }
}

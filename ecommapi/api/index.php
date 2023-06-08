<?php
include_once("functions.php");
if (!empty($_REQUEST['action'])) {
    /*Login*/
    if (!empty($_REQUEST['action']) and $_REQUEST['action'] == "login") {
        @$email = validate_data($dbc, $_REQUEST['email']);
        @$password = $_REQUEST['password'];
        @$userdata = fetchRecord($dbc, "tbl_user", "email", $email);
        $q = mysqli_query($dbc, "SELECT * FROM tbl_user WHERE email='$email' AND password ='$password'");
        $user = mysqli_fetch_assoc($q);
        @$count = mysqli_num_rows($q);
        @$data = mysqli_fetch_assoc($q);
        if ($count == 1) {
            $response = [
                "msg" => "Logging...",
                "status" => true,
                "action" => $_REQUEST['action'],
                "data" => $user
            ];
        } else {
            $response = [
                "msg" => "Invalid Email or Password",
                "status" => false,
                "action" => $_REQUEST['action'],
                "sts" => "eror"
            ];
        }
    }
    /*Sign Up*/ elseif (!empty($_REQUEST['action']) and $_REQUEST['action'] == "signup") {
        @$name = trim($_REQUEST['name']);
        @$email = trim($_REQUEST['email']);
        @$password = trim($_REQUEST['password']);
        $qry = "select * from tbl_user where email='$email'";
        $raw = mysqli_query($dbc, $qry);
        $count = mysqli_num_rows($raw);
        if ($count > 0) {
            $response = [
                "msg" => "User Already Exists",
                "status" => false,
                "action" => $_REQUEST['action']
            ];
        } else {
            $sql = "INSERT INTO tbl_user (name, email, password) 
                             VALUES ('$name', '$email', '$password')";
            $res = mysqli_query($dbc, $sql);
            if ($res == true) {
                $response = [
                    "msg" => "New User Registered",
                    "status" => true,
                    "action" => $_REQUEST['action']
                ];
            } else {
                $response = [
                    "msg" => mysqli_error($dbc),
                    "status" => false,
                    "action" => $_REQUEST['action']
                ];
            }
        }
    }
    /*Update User Profile */ elseif (!empty($_REQUEST['action']) and $_REQUEST['action'] == "update_user_profile" and $_REQUEST['user_id']) {
        @$name = trim($_REQUEST['name']);
        @$email = trim($_REQUEST['email']);
        @$password = trim($_REQUEST['password']);
        @$contact = $_REQUEST['contact'];
        @$address = $_REQUEST['address'];
        @$city = $_REQUEST['city'];
        $sql = " UPDATE tbl_user SET name='$name',email='$email', password ='$password', contact ='$contact', address='$address', city='$city' WHERE id = " . $_REQUEST['user_id'] . "";
        $res = mysqli_query($dbc, $sql);
        if ($res == true) {
            $response = [
                "msg" => "User Updated",
                "status" => true,
                "action" => $_REQUEST['action']
            ];
        } else {
            $response = [
                "msg" => mysqli_error($dbc),
                "status" => false,
                "action" => $_REQUEST['action']
            ];
        }
    }/*Profile Pic Upload*/ elseif (!empty($_REQUEST['action']) and $_REQUEST['action'] == "profile_pic_update" and $_REQUEST['user_id']) {
        $img = $_FILES['img'];
        if (empty($img)) {
            $response = [
                "msg" => "Image Not Selected",
                "sts" => false,
                "action" => $_REQUEST['action'],
            ];
        } else {
            $name = $img['name'];
            $tmpname = $img['tmp_name'];
            $tempname = uniqid() . '_' . $name;
            $path = "uploads/" . $tempname;
            if (move_uploaded_file($tmpname, $path)) {
                $img_upload = mysqli_query($dbc, "UPDATE tbl_user SET user_pic ='$tempname' WHERE id = " . $_REQUEST['user_id'] . " ");
                if ($img_upload) {
                    $response = [
                        "msg" => "Profile Update",
                        "sts" => "success",
                        "pic_name" => $name,
                        "img_path" => 'https://lms.cgit.pk/uploads/' . $tempname,
                        "action" => $_REQUEST['action'],
                        "status" => true
                    ];
                } else {
                    $response = [
                        "msg" => mysqli_error($dbc),
                        "sts" => "danger",
                        "action" => $_REQUEST['action'],
                        "status" => false
                    ];
                }
            } else {
                $response = [
                    "msg" => "error in uploading picture",
                    "pic_name" => "",
                    "img_path" => "",
                    "sts" => "danger",
                    "action" => $_REQUEST['action'],
                    "status" => false

                ];
            }
        }
    }
    /*Show All Products */ elseif (!empty($_REQUEST['action']) and $_REQUEST['action'] == "show_products") {
        if (!empty($_REQUEST['category']) and $_REQUEST['category'] == "all") {
            $sql = mysqli_query($dbc, "SELECT * FROM tbl_product");
        } elseif (!empty($_REQUEST['category']) and $_REQUEST['category'] == "new_arrivals_products") {
            $sql = mysqli_query($dbc, "SELECT * FROM tbl_product ORDER BY id DESC LIMIT  " . $_REQUEST['limit'] . "  ");
        } elseif (!empty($_REQUEST['category'])) {
            $sql = mysqli_query($dbc, "SELECT * FROM tbl_product WHERE catname = '" . $_REQUEST['category'] . "'  ORDER BY id DESC ");
        } else {
            $sql = mysqli_query($dbc, "SELECT * FROM tbl_product");
        }
        while ($product = mysqli_fetch_assoc($sql)) {
            $data[] = $product;
        }
        $response = [
            'msg' => "Product Showing",
            'sts' => true,
            'action' => $_REQUEST['action'],
            'data' => $data
        ];
    }/*Show  New Arrival Products */ elseif (!empty($_REQUEST['action']) and $_REQUEST['action'] == "new_arrivals_products" and $_REQUEST['limit']) {
        $sql = mysqli_query($dbc, "SELECT * FROM tbl_product ORDER BY id DESC LIMIT  " . $_REQUEST['limit'] . "  ");
        while ($product = mysqli_fetch_assoc($sql)) {
            $data[] = $product;
        }
        $response = [
            'msg' => "Product Showing",
            'sts' => true,
            'action' => $_REQUEST['action'],
            'data' => $data
        ];
    }
    /*Show Products by Category */ elseif (!empty($_REQUEST['action']) and $_REQUEST['action'] == "products_by_category" and $_REQUEST['category']) {
        $sql = mysqli_query($dbc, "SELECT * FROM tbl_product WHERE catname = '" . $_REQUEST['category'] . "'  ORDER BY id DESC ");
        while ($product = mysqli_fetch_assoc($sql)) {
            $data[] = $product;
        }
        $response = [
            'msg' => "Product Showing By Category",
            'sts' => true,
            'action' => $_REQUEST['action'],
            'data' => $data
        ];
    }

    /*Show All Categories*/ elseif (!empty($_REQUEST['action']) and $_REQUEST['action'] == "show_all_Categories") {
        $sql = mysqli_query($dbc, "SELECT * FROM tbl_category");
        while ($product = mysqli_fetch_assoc($sql)) {
            $data[] = $product;
        }
        $response = [
            'msg' => "AllCategories Showing",
            'sts' => true,
            'action' => $_REQUEST['action'],
            'data' => $data
        ];
    }
    /*Order Place Code Sales Items*/ elseif (!empty($_REQUEST['action']) and $_REQUEST['action'] == "place_order" and !empty($_REQUEST['user_id'])) {
        $order_date = [
            'user_name' => $_REQUEST['user_name'],
            'useremail' => $_REQUEST['useremail'],
            'user_phone' => $_REQUEST['user_phone'],
            'user_address' => $_REQUEST['user_address'],
            'user_city' => $_REQUEST['user_city'],
            'user_id' => $_REQUEST['user_id']
        ];
        if (insert_data($dbc, "tbl_orders", $order_date)) {
            $order_id = mysqli_insert_id($dbc);
            for ($i = 0; $i < count($_REQUEST['product_id']); $i++) {
                $order_items = [
                    'order_id' => $order_id,
                    'product_id' => $_REQUEST['product_id'][$i],
                    'size' => $_REQUEST['size'][$i],
                    'qty' => $_REQUEST['qty'][$i],
                    'price' => $_REQUEST['price'][$i],
                    'sub_total' => $_REQUEST['sub_total'][$i]
                ];
                if (insert_data($dbc, "order_items", $order_items)) {
                    $response = [
                        'msg' => "Order Placed",
                        'sts' => true,
                        'action' => $_REQUEST['action']
                    ];
                }
            }
        }
    }
    /*Order Showing Code Sales Items*/ elseif (!empty($_REQUEST['action']) and $_REQUEST['action'] == "show_order_details" and !empty($_REQUEST['user_id'])){
        $sql = mysqli_query($dbc, "SELECT * FROM tbl_orders");
        while ($orders = mysqli_fetch_assoc($sql)) {
            $order_details[] = $orders;
        }
        $response = [
            'msg' => "Order Details Showing",
            'sts' => true,
            'action' => $_REQUEST['action'],
            'data' => $order_details
        ];
    }
}
if (empty($response)) {
    $response = [
        "msg" => "invalid api call. Undefined Action",
        'sts' => "danger",
        "action" => ''
    ];
}
echo json_encode($response);

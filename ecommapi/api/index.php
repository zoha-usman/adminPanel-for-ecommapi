<?php
include_once("functions.php");
if (!empty($_REQUEST['action'])) {
    /*Login*/
    if (!empty($_REQUEST['action']) and $_REQUEST['action'] == "login") {
        @$email = validate_data($dbc, $_REQUEST['email']);
        @$password = $_REQUEST['password'];
        @$userdata = fetchRecord($dbc, "tbl_user", "email", $email);
        $q = mysqli_query($dbc, "SELECT * FROM tbl_user WHERE email='$email' AND password ='$password'");
        $user= mysqli_fetch_assoc($q);
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
                "action" => $_REQUEST['action']
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
        @$contact = trim($_REQUEST['contact']);
        @$address = trim($_REQUEST['address']);
        @$city= trim($_REQUEST['city']);
        $sql = " UPDATE tbl_user SET name='$name',email='$email',password='$password', contact ='$contact', address='$address', city='$city' WHERE id = " . $_REQUEST['user_id'] . "";
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
    }
    /*Show All Products */ elseif (!empty($_REQUEST['action']) and $_REQUEST['action'] == "show_products" ) {
       if (!empty($_REQUEST['category']) and $_REQUEST['category']=="all") {
        $sql = mysqli_query($dbc, "SELECT * FROM tbl_product");
    }elseif (!empty($_REQUEST['category']) and $_REQUEST['category']=="new_arrivals_products") {
        $sql = mysqli_query($dbc, "SELECT * FROM tbl_product ORDER BY id DESC LIMIT  " . $_REQUEST['limit'] . "  ");
    }elseif (!empty($_REQUEST['category']) ) {
        $sql = mysqli_query($dbc, "SELECT * FROM tbl_product WHERE catname = '" . $_REQUEST['category'] . "'  ORDER BY id DESC ");
    }else{
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


else {
    $response = [
        'msg' => "undefine api call",
        'sts' => false,
        'action' => ""
    ];
}
echo json_encode($response);
}
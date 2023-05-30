<?php
session_start();
$conn=mysqli_connect("localhost","root","");
mysqli_select_db($conn,"ecommdb");
 if($_REQUEST['action']){
   if ($_REQUEST['action'] == "showall") {
    $sql= mysqli_query($conn,"SELECT * FROM tbl_product");
    while($product=mysqli_fetch_assoc($sql)) {
          $data[] = $product;
    }
    $response = [
    'msg' => "Product Showing", 
    'sts' => true,
   'action' => $_REQUEST['action'],
   'data' => $data
];
 }
 elseif ($_REQUEST['action'] == "new_arrivals" and $_REQUEST['limit']) {
      $sql= mysqli_query($conn,"SELECT * FROM tbl_product ORDER BY id DESC LIMIT  ".$_REQUEST['limit']."  ");
      while($product=mysqli_fetch_assoc($sql)) {
            $data[] = $product;
      }
      $response = [
      'msg' => "Product Showing", 
      'sts' => true,
     'action' => $_REQUEST['action'],
     'data' => $data
  ];
   }
   elseif ($_REQUEST['action'] == "man") {
      $sql= mysqli_query($conn,"SELECT * FROM tbl_product");
      while($product=mysqli_fetch_assoc($sql)) {
            $data[] = $product;
      }
      $response = [
      'msg' => "Product Showing", 
      'sts' => true,
     'action' => $_REQUEST['action'],
     'data' => $data
  ];
   }
   elseif($_REQUEST['action'] == "showuser") {
      $sql= mysqli_query($conn,"SELECT * FROM tbl_user");
      while($product=mysqli_fetch_assoc($sql)) {
            $data[] = $product;
      }
      $response = [
      'msg' => "Product Showing", 
      'sts' => true,
     'action' => $_REQUEST['action'],
     'data' => $data
  ];
   }
}
else{
    $response = ['msg' => "undefine api call", 
                    'sts' => false,
                   'action' => ""
                ];
 }

 echo json_encode($response);
?>
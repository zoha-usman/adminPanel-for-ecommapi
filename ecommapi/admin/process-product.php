<?php
session_start();
$conn=mysqli_connect("localhost","root","");
mysqli_select_db($conn,"ecommdb");
 $catname=$_POST['category'];
 $pname =$_POST['pname'];
 $price=$_POST['price'];
 $sdesc=$_POST['sdesc'];
 $stock= $_POST['stock'];
 if($_FILES['upload']){
    $sn=$_FILES['upload']['tmp_name'];//mydocument/mypicture/hello.jpg
    $on=$_FILES['upload']['name'];//hello.jpg
    $dn="images/".$on;
    move_uploaded_file($sn,$dn);


   $qry="INSERT INTO tbl_product(catname ,pname,pimage, pdesc, price , `status`, stock)
    VALUES ('$catname', '$pname', '$on', '$sdesc', '$price', '1', '$stock');";
   
   $res=mysqli_query($conn,$qry);
   if($res)
    $_SESSION['msg1']="Inserted Successfully";
else
    $_SESSION['msg2']="Something went wrong ";
    

    header("location:add_product.php");

 }

?>
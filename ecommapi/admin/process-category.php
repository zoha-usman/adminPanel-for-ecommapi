<?php
session_start();
$conn=mysqli_connect("localhost","root","");
mysqli_select_db($conn,"ecommdb");

 $cname=$_POST['cname'];
 $sdesc=$_POST['sdesc'];
 if($_FILES['upload']){
    $sn=$_FILES['upload']['tmp_name'];//mydocument/mypicture/hello.jpg
    $on=$_FILES['upload']['name'];//hello.jpg
    $dn="catimages/".$on;
    move_uploaded_file($sn,$dn);


   $qry="INSERT INTO tbl_category (id, catname, image, sdesc, status) 
   VALUES (NULL, '$cname', '$on', '$sdesc', '1')";
   
   $res=mysqli_query($conn,$qry);
   if($res==true)
    $_SESSION['msg1']="Inserted Successfully";
else
    $_SESSION['msg2']="Something went wrong ";
    

    header("location:add_category.php");

 }

?>
<?php

$dir="category/";

$file=$dir.basename($_FILES['catimage']['name']);
//echo getcwd();

$id=$_POST["id"];
if($_FILES['catimage']['size'] > 2097152){
    echo "File must be less than 2 mb";
}
else{
    if (move_uploaded_file($_FILES["catimage"]["tmp_name"],$file)) {
        $filename=basename($_FILES["catimage"]["name"]);
        update_image($id,$filename);
        //echo "The file ". htmlspecialchars( basename( $_FILES["imguser"]["name"])). " has been uploaded.";
           
    }
    else{
      echo "ERROR";
    }
}

function update_image($i,$f){
include 'conn.php';
$str="UPDATE tbcategories SET catimg='$f' WHERE catid=$i";
$cmd=mysqli_query($db,$str);
if($cmd){
    echo "The file has been uploaded.";
}
else{
    echo mysqli_error($db);
}
mysqli_close($db);
}
?>
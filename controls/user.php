<?php

$action=$_POST["action"];

switch($action)
{
    case "login":
        login_user();
        break;
    case "load":
        load_user();
        break;
    case "update":
        update_user();
        break;
}
function update_user() {
    include "conn.php";
    $name=$_POST["name"];
    $email=$_POST["email"];
    $username=$_POST["username"];
    $password=$_POST["password"];
    $str="UPDATE tbuser SET fullname='$name',email='$email',username='$username',password='$password' 
        WHERE usertype='admin'";
    $qry=mysqli_query($db,$str);
    if($qry){
        echo "OK";
    }
    else{
        echo mysqli_error($db);
    }
    mysqli_close($db);
}
function login_user(){
include "conn.php";
$data=$_POST["content"];
$user=mysqli_real_escape_string($db,$data[0]);
$pass=mysqli_real_escape_string($db,$data[1]);
$str="SELECT * FROM tbuser WHERE username='$user' or email='$user' and password='$pass'";
$qry=mysqli_query($db,$str);
$row=mysqli_num_rows($qry);
if($row > 0){
    session_start();
    foreach($qry as $val){
    $_SESSION["usertype"]="admin";
    $_SESSION["username"]=$val["username"];
    $_SESSION["userid"]=$val["userid"];
    }
    echo "1";
   
    
    //$_SESSION["userid"]=
}
else{
    echo "0";
}
mysqli_close($db);
}

function load_user() {
    include "conn.php";
    $str="SELECT * FROM tbuser WHERE usertype='admin'";
    $qry=mysqli_query($db,$str);
    $data=array();
    while($row=mysqli_fetch_assoc($qry)){
        array_push($data,$row);
    }
    echo json_encode($data);
    mysqli_close($db);

}

?>
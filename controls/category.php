<?php
if(!isset($_POST["action"])){
    header("../location:index.php");
}

$action=$_POST["action"];
switch($action){

    case "delete":
        delete_category();
        break;

    case "load":
        load_categories();
        break;

    case "categorylist":
        category_list();
        break;

    case "search":
        search_categories();
        break;

    case "save":
        if(check_title2()>0){
            echo "Title already exists";
        }
        else{
            save_category();
        }
        break;
       
    case "update":
        if(check_title()==0){
            update_category();
        }
        else {
            echo "Title already exists";
        }
        break;
    //client
    case "listcategory":
        list_category();
        break;
        default:
        //error

    
}
function list_category(){
    include "conn.php";
    $str="SELECT catid,cattitle,catimg,catdesc FROM tbcategories";
    $qry=mysqli_query($db,$str);
    $row=mysqli_num_rows($qry);
    if($row > 0){
        $data="";
        while($value=mysqli_fetch_array($qry)){
            $img="controls/category/$value[2]";
            $url="cards.php?id=".$value[0]."&name=".$value[1];
            $data.='<div class="col-md-6 col-lg-4">
            <div class="card border-0"><a href="'.$url.'"><img class="card-img-top scale-on-hover" src="'.$img.'" alt="'.$value[1].'"></a>
                <div class="card-body">
                    <h6><a href="#">'.$value[1].'</a></h6>
                    <p class="text-muted card-text">'.$value[3].'</p>
                </div>
            </div>
        </div>';
        }
        echo $data;
    }
    else {
        echo "NONE";
    }
    mysqli_close($db);
}
function category_list(){
    include "conn.php";
    $str="SELECT catid,cattitle FROM tbcategories";
    $qry=mysqli_query($db,$str);
    $row=mysqli_num_rows($qry);
    if($row > 0){
        $data="";
        while($value=mysqli_fetch_array($qry)){
            $data.="<option value='$value[0]'>$value[1]</option>";
        }
        echo $data;
    }
    else {
        echo "NONE";
    }
    mysqli_close($db);
}
function delete_category(){
    include "conn.php";
    
    $id=$_POST["catid"];
    $str="DELETE FROM tbcategories WHERE catid=$id"; 
    $qry=mysqli_query($db,$str);
    if($qry){
        echo "OK";
    }
    else {
    mysqli_error($db);
    }
    mysqli_close($db);
}

function check_title2(){
    include "conn.php";
    
    $title=$_POST["title"];
    $str="SELECT * FROM tbcategories WHERE cattitle='$title'"; 
    $qry=mysqli_query($db,$str);
    $row=mysqli_num_rows($qry);
    return $row;
    mysqli_close($db);
}
function check_title(){
    include "conn.php";
    $id=$_POST["catid"];
    $title=$_POST["title"];
    $str="SELECT * FROM tbcategories WHERE cattitle='$title' AND catid<>$id"; 
    $qry=mysqli_query($db,$str);
    $row=mysqli_num_rows($qry);
    return $row;
    mysqli_close($db);
}
function update_category(){
    include "conn.php";
    $id=$_POST["catid"];
    $title=$_POST["title"];
    $description=$_POST["description"];
   
    $str="UPDATE tbcategories SET cattitle='$title',catdesc='$description' 
    WHERE catid=$id";
    $qry=mysqli_query($db,$str);
    if($qry){
        echo "OK";
    }
    else {
        echo mysqli_error($db);
    }
    mysqli_close($db);
}
function save_category(){
    include "conn.php";
    $title=$_POST["title"];
    $description=$_POST["description"];
    $image="noimage.png";
    $str="INSERT INTO tbcategories (cattitle,catdesc,catimg) 
    VALUES ('$title','$description','$image')";
    $qry=mysqli_query($db,$str);
    if($qry){
        echo "OK";
    }
    else {
        echo "ERROR";
    }
    mysqli_close($db);
}
function load_categories(){
   
include "conn.php";
$str="SELECT * FROM tbcategories ORDER BY tbcategories.catid DESC";
$qry=mysqli_query($db,$str);
$row=mysqli_num_rows($qry);
if($row > 0){
$data="";

while($value=mysqli_fetch_array($qry)){
    $title=urlencode($value[1]);
    $desc=urlencode($value[2]);
    $param="views/editcategory.php?id=$value[0]&title=$title&desc=$desc";
    $data.="<tr>
        <td width='200px' data-target='#imagemodal'  data-toggle='modal'>
        <img class='img img-thumbnail'src='controls/category/$value[3]' style='width:100%;height:auto;-o-object-fit: contain;' onclick='load_image(\"$value[0]\",\"$value[3]\")'/></td>
        <td>$value[1]</td>
        <td>$value[2]</td>
        <td><button class='btn btn-dark btn-sm text-white' onclick='edit_category(\"$param\")'>Edit</button></td>
        
    </tr>";

}
echo $data;
}
else{
    echo "<p class='alert alert-warning'>No categories found</p>";
}
mysqli_close($db);
}

function search_categories(){
   
    include "conn.php";
    $keyword=$_POST["keyword"];
    $str="SELECT * FROM tbcategories where cattitle LIKE '%$keyword%'";
    $qry=mysqli_query($db,$str);
    $row=mysqli_num_rows($qry);
    if($row > 0){
    $data="";
    
    while($value=mysqli_fetch_array($qry)){
        $title=urlencode($value[1]);
        $desc=urlencode($value[2]);
        $param="views/editcategory.php?id=$value[0]&title=$title&desc=$desc";
        $data.="<tr>
            <td width='200px' data-target='#imagemodal'  data-toggle='modal'>
            <img class='img img-thumbnail'src='controls/category/$value[3]' style='width:100%;height:auto;-o-object-fit: contain;' onclick='load_image(\"$value[0]\",\"$value[3]\")'/></td>
            <td>$value[1]</td>
            <td>$value[2]</td>
            <td><button class='btn btn-info' onclick='edit_category(\"$param\")'>Edit</button></td>
            
        </tr>";
    
    }
    echo $data;
    }
    else{
        echo "<p class='alert alert-warning'>No categories found</p>";
    }
    mysqli_close($db);
    }
?>
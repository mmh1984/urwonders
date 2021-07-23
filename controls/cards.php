<?php
if(!isset($_POST["action"])){
    header("../location:index.php");
}

$action=$_POST["action"];
switch($action){
    case "load":
        load_cards();
        break;
    case "update":
        if(check_title()>0){
            echo "Title already exists";
        }
        else{
            update_card();
        }
        break;
    
    case "filter":
        filter_cards();
        break;
    case "search":
        search_cards();
        break;
    case "save":
        if(check_title2()>0){
            echo "Title already exists";
        }
        else{
            save_card();
        }
        break;
    case "delete":
        delete_cards();
        break;
    //client
    case "listcard":
        list_card();
        break;
    case "allcards":
        all_cards();
        break;
    case "searchcards":
    search_cards_keyword();
        break;
    
}
function search_cards_keyword(){
    include "conn.php";
    $keyword=$_POST["keyword"];
   
    $str="SELECT cardid,cardname,carddesc,cardimage FROM tbcards
    WHERE cardname LIKE '%$keyword%' 
    OR carddesc LIKE '%$keyword%' 
    OR cardtag LIKE '%$keyword%'";
    $qry=mysqli_query($db,$str);
    $row=mysqli_num_rows($qry);
    if($row > 0){
        $data="";
        $data.="<script>$('#count').html(".$row.")</script>";
        while($value=mysqli_fetch_array($qry)){
            $img="controls/cards/$value[3]";
            $url="cards.php?id=".$value[0]."&name=".$value[1];
            $data.='<div class="col-sm-6 col-md-4 col-lg-3 item">
            <a data-lightbox="photos" href="'.$img.'">
            <img class="img-fluid scale-on-hover" style="width:200px;height:200px;display:block;margin:0 auto;" src="'.$img.'" alt="'.$value[1].'" />
            </a>
            <h4 class="text-center">'.$value[1].'</h4>
            </div>';
        }
        echo $data;
    }
    else {
        echo "<p class='alert alert-warning'>No results</p>";
    }
    mysqli_close($db);
}

function all_cards(){
    include "conn.php";
    
    $str="SELECT cardid,cardname,carddesc,cardimage FROM tbcards";
    $qry=mysqli_query($db,$str);
    $row=mysqli_num_rows($qry);
    if($row > 0){
        $data="";
        $data.="<script>$('#count').html(".$row.")</script>";
        while($value=mysqli_fetch_array($qry)){
            $img="controls/cards/$value[3]";
            $url="cards.php?id=".$value[0]."&name=".$value[1];
            $data.='<div class="col-sm-6 col-md-4 col-lg-3 item">
            <a data-lightbox="photos" href="'.$img.'">
            <img class="img-fluid scale-on-hover" style="width:200px;height:200px;display:block;margin:0 auto;" src="'.$img.'" alt="'.$value[1].'" />
            </a>
            <h4 class="text-center">'.$value[1].'</h4>
            </div>';
        }
        echo $data;
    }
    else {
        echo "NONE";
    }
    mysqli_close($db);
}
function list_card(){
    include "conn.php";
    $id=$_POST["id"];
    $str="SELECT cardid,cardname,carddesc,cardimage FROM tbcards WHERE catid=$id";
    $qry=mysqli_query($db,$str);
    $row=mysqli_num_rows($qry);
    if($row > 0){
        $data="";
        $data.="<script>$('#count').html(".$row.")</script>";
        while($value=mysqli_fetch_array($qry)){
            $img="controls/cards/$value[3]";
            $url="cards.php?id=".$value[0]."&name=".$value[1];
            $data.='<div class="col-sm-6 col-md-4 col-lg-3 item">
            <a data-lightbox="photos" href="'.$img.'">
            <img class="img-fluid scale-on-hover" style="width:200px;height:200px;display:block;margin:0 auto;" src="'.$img.'" alt="'.$value[1].'" />
            </a>
            <h4 class="text-center">'.$value[1].'</h4>
            </div>';
        }
        echo $data;
    }
    else {
        echo "NONE";
    }
    mysqli_close($db);
}
function delete_cards(){
    include "conn.php";
    
    $id=$_POST["cardid"];
    $str="DELETE FROM tbcards WHERE cardid=$id"; 
    $qry=mysqli_query($db,$str);
    if($qry){
        echo "OK";
    }
    else {
    mysqli_error($db);
    }
    mysqli_Close($db);
}
function check_title2(){
    include "conn.php";
    
    $name=mysqli_real_escape_string($db,$_POST["name"]);
    $category=$_POST["category"];
    $str="SELECT * FROM tbcards WHERE cardname='$name' AND catid=$category"; 
    $qry=mysqli_query($db,$str);
    $row=mysqli_num_rows($qry);
    return $row;
    mysqli_close($db);
}
function check_title(){
    include "conn.php";
    
    $name=mysqli_real_escape_string($db,$_POST["name"]);
    $category=$_POST["category"];
    $id=$_POST["id"];
    $str="SELECT * FROM tbcards WHERE cardname='$name' AND catid=$category AND cardid <> $id"; 
    $qry=mysqli_query($db,$str);
    $row=mysqli_num_rows($qry);
    return $row;
    mysqli_close($db);
}
function update_card(){
    include "conn.php";
    $name=mysqli_real_escape_string($db,$_POST["name"]);
    $category=$_POST["category"];
    $description=$_POST["description"];
    $tag=$_POST["tag"];
    $id=$_POST["id"];
    $str="UPDATE tbcards SET cardname='$name',catid=$category,carddesc='$description',
    cardtag='$tag' WHERE cardid=$id";
    $qry=mysqli_query($db,$str);
    if($qry){
        echo "OK";
    }
    else {
        echo "ERROR";
    }
    mysqli_close($db);
}

function save_card(){
    include "conn.php";
    $name=mysqli_real_escape_string($db,$_POST["name"]);
    $category=$_POST["category"];
    $description=$_POST["description"];
    $tag=$_POST["tag"];
    $image="noimage.png";
    $str="INSERT INTO tbcards (cardname,catid,carddesc,cardtag,cardimage) 
    VALUES ('$name',$category,'$description','$tag','$image')";
    $qry=mysqli_query($db,$str);
    if($qry){
        
        echo "OK";
        
    }
    else {
        echo "ERROR";
    }
    mysqli_close($db);
}
function filter_cards(){
    
   
    include "conn.php";
    $category=$_POST["category"];
    $str="SELECT tbcards.cardid,tbcards.cardname,tbcategories.cattitle,tbcards.carddesc,tbcards.cardtag,tbcards.cardimage
    FROM tbcards,tbcategories WHERE tbcategories.catid=tbcards.catid 
    AND tbcards.catid =$category ORDER BY tbcards.cardid DESC";
    $qry=mysqli_query($db,$str);
    $row=mysqli_num_rows($qry);
    if($row > 0){
    $data="";
    
    while($value=mysqli_fetch_array($qry)){
        $name=urlencode($value[1]);
        $cat=urlencode(($value[2]));
        $desc=urlencode($value[3]);
        $tag=urlencode($value[4]);
        $param="views/editcard.php?id=$value[0]&name=$name&category=$cat&desc=$desc&tag=$tag";
        $data.="<tr>
            <td width='200px' data-target='#imagemodal'  data-toggle='modal'>
            <img class='img img-thumbnail'src='controls/cards/$value[5]' style='width:50%;height:auto;-o-object-fit: contain;' onclick='load_image(\"$value[0]\",\"$value[5]\")'/></td>
            <td>$value[1]</td>
            <td>$value[2]</td>
            <td>$value[3]</td>
            <td>$value[4]</td>
            <td><button class='btn btn-dark btn-sm text-white' onclick='edit_card(\"$param\")'>Edit</button></td>
            
        </tr>";
        
    }
    echo $data;
}
    else{
        echo "<p class='alert alert-warning'>No cards found</p>";
    }
    mysqli_close($db);
}
function search_cards(){
    
   
    include "conn.php";
    $keyword=$_POST["keyword"];
    $str="SELECT tbcards.cardid,tbcards.cardname,tbcategories.cattitle,tbcards.carddesc,tbcards.cardtag,tbcards.cardimage
    FROM tbcards,tbcategories WHERE tbcategories.catid=tbcards.catid 
    AND tbcards.cardname LIKE '%$keyword%'";
    $qry=mysqli_query($db,$str);
    $row=mysqli_num_rows($qry);
    if($row > 0){
    $data="";
    
    while($value=mysqli_fetch_array($qry)){
        $name=urlencode($value[1]);
        $cat=urlencode(($value[2]));
        $desc=urlencode($value[3]);
        $tag=urlencode($value[4]);
        $param="views/editcard.php?id=$value[0]&name=$name&category=$cat&desc=$desc&tag=$tag";
        $data.="<tr>
            <td width='200px' data-target='#imagemodal'  data-toggle='modal'>
            <img class='img img-thumbnail'src='controls/cards/$value[5]' style='width:50%;height:auto;-o-object-fit: contain;' onclick='load_image(\"$value[0]\",\"$value[5]\")'/></td>
            <td>$value[1]</td>
            <td>$value[2]</td>
            <td>$value[3]</td>
            <td>$value[4]</td>
            <td><button class='btn btn-dark btn-sm text-white' onclick='edit_card(\"$param\")'>Edit</button></td>
            
        </tr>";
        
    }
    echo $data;
}
    else{
        echo "<p class='alert alert-warning'>No cards found</p>";
    }
    mysqli_close($db);
}
function load_cards(){
    
   
        include "conn.php";
        $str="SELECT tbcards.cardid,tbcards.cardname,tbcategories.cattitle,tbcards.carddesc,tbcards.cardtag,tbcards.cardimage
        FROM tbcards,tbcategories WHERE tbcategories.catid=tbcards.catid ORDER BY tbcards.cardid DESC";
        $qry=mysqli_query($db,$str);
        $row=mysqli_num_rows($qry);
        if($row > 0){
        $data="";
        
        while($value=mysqli_fetch_array($qry)){
            $name=urlencode($value[1]);
            $cat=urlencode(($value[2]));
            $desc=urlencode($value[3]);
            $tag=urlencode($value[4]);
            $param="views/editcard.php?id=$value[0]&name=$name&category=$cat&desc=$desc&tag=$tag";
            $data.="<tr>
                <td width='200px' data-target='#imagemodal'  data-toggle='modal'>
                <img class='img img-thumbnail'src='controls/cards/$value[5]' style='width:50%;height:auto;-o-object-fit: contain;' onclick='load_image(\"$value[0]\",\"$value[5]\")'/></td>
                <td>$value[1]</td>
                <td>$value[2]</td>
                <td>$value[3]</td>
                <td>$value[4]</td>
                <td><button class='btn btn-dark btn-sm text-white' onclick='edit_card(\"$param\")'>Edit</button></td>
                
            </tr>";
        
        }
        echo $data;
}
else{
    echo "<p class='alert alert-warning'>No cards found</p>";
}
mysqli_close($db);
}





?>
<?php
include 'conn.php';
$str="SELECT * FROM tbcards order by RAND() LIMIT 10";
$qry=mysqli_query($db,$str);
$row=mysqli_num_rows($qry);
$data=array();
if($row > 0){
while($value=mysqli_fetch_assoc($qry)){
array_push($data,$value);
}
echo json_encode($data);
}
else {
    echo json_encode($data);
}
echo mysqli_error($db);
mysqli_close($db);
?>
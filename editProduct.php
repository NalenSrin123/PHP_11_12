<?php 
    include "connection.php";
    global $con;
    date_default_timezone_set('asia/phnom_penh');
    $code=$_POST['code'];
    $name=$_POST['name'];
    $r_price=(float)$_POST['r_price'];
    $s_price=(float)$_POST['s_price'];
    $stock=$_POST['stock'];
    $size=implode(',',$_POST['size']);
    $color=implode(',',$_POST['color']);
    $des=$_POST['des'];
    $name_image=$_POST['name_image'];
    $update_at=date('ymdhis');
    $update="UPDATE `tbproduct` SET `name`='$name',`r_price`='$r_price',`s_price`='$s_price',`stock`='$stock',`size`='$size',`color`='$color'
    ,`description`='$des',`image`='$name_image',`update_at`='$update_at' WHERE `id`= '$code'";
    $res=$con->query($update);
    if($res){
        echo $name_image;
    }
    

?>
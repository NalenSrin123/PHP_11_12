<?php 
    include 'connection.php';
    $name=$_POST['name'];
    $r_price=(float)$_POST['r_price'];
    $s_price=(float)$_POST['s_price'];
    $stock=$_POST['stock'];
    $size=implode(',',$_POST['size']);
    $color=implode(',',$_POST['color']);
    $des=$_POST['des'];
    $name_image=$_POST['name_image'];
    global $con;
    $insert="INSERT INTO `tbproduct`(`name`, `r_price`, `s_price`, `stock`, `size`, `color`, `description`, `image`) 
        VALUES ('$name','$r_price','$s_price','$stock','$size','$color','$des','$name_image')";
    $res=$con->query($insert); 
    $getId="SELECT `id` FROM `tbproduct` ORDER BY `id` DESC limit 1";
    $id=$con->query($getId);
    echo $id->fetch_assoc()['id'];
?>
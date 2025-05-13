<?php 
    include "connection.php";
    global $con;
    $id=$_POST['hide_id'];
    $delete="DELETE FROM `tbproduct` WHERE `id`='$id'";
    $result=$con->query($delete);
    if($result){
        echo 'Success';
    }
?>
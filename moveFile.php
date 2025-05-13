<?php 
    $image=rand(1,10000).'_'.$_FILES['image']['name'];
    $tmp_name=$_FILES['image']['tmp_name'];
    $path="uploads/".$image;
    move_uploaded_file($tmp_name,$path);
    echo $image;
?>
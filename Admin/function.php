<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ETEC SHOP</title>
    <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRmfgEsISgcMna9mdI-t_XY7o-WkAI0ctitvg&s">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    
</body>
</html>
<?php 
session_start();

    include "../connection.php";
    function moveFile($name){
        $image=rand(1,1000).'_'.$_FILES[$name]['name'];
        $tmp_name=$_FILES[$name]['tmp_name'];
        $path='../uploads/'.$image;
        move_uploaded_file($tmp_name,$path);
        return $image;
    }
    function signUp(){
        if(isset($_POST['signup'])){
            $username=htmlspecialchars($_POST['username']);
            if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                $email=$_POST['email'];
            }
            $password=password_hash($_POST['password'],PASSWORD_BCRYPT);
            $profile=moveFile('profile');
            if($username=='' && $email=='' && $password=='' && $profile==''){
                echo "Error";
            }else{  
                global $con;
                $sql="INSERT INTO `crud_user`( `userName`, `email`, `password`, `profile`) 
                VALUES ('$username','$email','$password','$profile')";
                if($con->query($sql)){
                    echo '<script>window.location.href="login.php"</script>';
                }
            }
        }
    }
    signUp();
    function login(){
        if(isset($_POST['login'])){
            $name_email=htmlspecialchars($_POST['name_email']);
            $password=$_POST['password'];
            global $con;
            $sql="SELECT `userName`, `email`, `password`, `role` FROM `crud_user` WHERE `userName`='$name_email' OR `email`='$name_email'";
            $resutl=$con->query($sql);
            if($resutl->num_rows>0){
                $row=$resutl->fetch_assoc();
                $hashPassword=$row['password'];
                if(password_verify($password,$hashPassword)){
                   $_SESSION['name_email']=$name_email;
                   $_SESSION['role']=$row['role'];
                     echo '<script>window.location.href="../index.php"</script>';
                }else{
                    echo '
                        <script>
                            Swal.fire({
                                title: "Not Found!",
                                text: "Invalid Password",
                                icon: "error"
                            }).then(() => {
                                window.location.href = "login.php";
                            });
                        </script>
                    ';
                }
            }else{
                echo '
                    <script>
                        Swal.fire({
                            title: "Not Found!",
                            text: "Invalid Username or Email!",
                            icon: "error"
                        }).then(() => {
                            window.location.href = "login.php";
                        });
                    </script>
                ';
            }
        
        }
    }
    login();
    function InsertProduct(){
        if(isset($_POST['insert'])){
            session_start();
           global $con;
           $user=$_SESSION['name_email'];
           $userID="SELECT `userID` FROM `crud_user` WHERE `userName`='$user' OR `email`='$user'";
           $result=$con->query($userID); 
           $id=$result->fetch_assoc()['userID'];
           $pro_name=htmlspecialchars($_POST['name']);
            $r_price=$_POST['r_price']; 
            $s_price=$_POST['s_price'];
            $image=moveFile('Image');
            $insert="INSERT INTO `crud_menu`( `menu_name`, `reqular_price`, `sale_price`, `image`, `user_id`) 
            VALUES ('$pro_name','$r_price','$s_price','$image','$id')";
            if($con->query($insert)){
                echo '
                    <script>
                        window.location.href = "add-product.php";
                    </script>                   
                ';
            }
        }
    }
    InsertProduct();
    function deleteProduct(){
        if(isset($_POST['delete'])){
            $id=$_POST['hide_id'];
           global $con;
           $delete="DELETE FROM `crud_menu` WHERE `menu_id`='$id'";
           if($con->query($delete)){
            echo '<script>window.location.href="viewProduct.php"</script>';
           }
        }
    }
    deleteProduct();
    function editProduct(){
        date_default_timezone_set('Asia/Phnom_Penh');
        if(isset($_POST['edit'])){
            $id=$_POST['hide_id'];
            $pro_name=htmlspecialchars($_POST['name']);
            $r_price=$_POST['r_price']; 
            $s_price=$_POST['s_price'];
            $update_at=date('Y-m-d H:i:s');
            if(empty($_FILES['Image']['name'])){
                $image=$_POST['old_image'];
            }else{
                $image=moveFile('Image');
            }
            global $con;
            $update="UPDATE `crud_menu` SET `menu_name`='$pro_name',`reqular_price`='$r_price',
            `sale_price`='$s_price',`image`='$image',`update_at`='$update_at' WHERE `menu_id`='$id'";
            if($con->query($update)){
                echo '<script>window.location.href="viewProduct.php"</script>';
            }
        }
    }
    editProduct();
?>
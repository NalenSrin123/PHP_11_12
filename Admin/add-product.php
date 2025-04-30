<?php 
session_start();
if(empty($_SESSION['name_email'])){
    echo '<script>window.location.href = "login.php";</script>';
    exit;

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<style>
    * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background: #f0f2f5;
        }

        .dashboard {
            display: flex;
            min-height: 100vh;
        }
        .right-content{
            margin-left: 250px;
            padding: 25px;
            width: 100%;
            
        }
</style>
<body>
    <div class="dashboard">
        <?php
            include 'sidebar.php';
        ?>  
         <div class="right-content">
              <h1 id="title"></h1> 
              <form action="function.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="r_price" class="form-label">Reqular Price</label>
                        <input type="text" name="r_price" id="r_price" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="s_price" class="form-label">Sale Price</label>
                        <input type="text" name="s_price" id="s_price" class="form-control">
                    </div>
                    <div class="form-group" id="group">
                        <label for="Image" class="form-label">Image</label>
                        <input type="file" name="Image" id="Image" class="form-control">
                        
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary mt-3 me-2" id="save" name="insert">Save</button>
                        <button class="btn btn-success mt-3 me-2" id="edit" name="edit">Edit</button>
                        <button class="btn btn-danger mt-3 me-3"><a href="viewProduct.php" style="text-decoration: none; color: #fff;">Cancel</a></button>
                    </div>
              </form> 
         </div> 
    </div>
</body>
<script>
    $(document).ready(function(){
        var url = window.location.href;
        var path = url.split("/").pop();
        if (path != 'add-product.php') {
            $("#title").text("Edit Product");
            $("#save").hide();
            $("#edit").show();
            
           
            <?php 
                include '../connection.php';
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM `crud_menu` WHERE `menu_id` = '$id'";
                    $result = $con->query($sql);
                    $row = $result->fetch_assoc();

                    $name = htmlspecialchars($row['menu_name'], ENT_QUOTES);
                    $r_price = htmlspecialchars($row['reqular_price'], ENT_QUOTES);
                    $s_price = htmlspecialchars($row['sale_price'], ENT_QUOTES);
                    $image = htmlspecialchars($row['image'], ENT_QUOTES);

                    echo <<<JS
                        $("#name").val("{$name}");
                        $("#r_price").val("{$r_price}");
                        $("#s_price").val("{$s_price}");
                        $("#group").append(`<input type="hidden" name="old_image" id="old_image" class="form-control" value="{$image}">`);
                        $("#group").append(`<input type="hidden" name="hide_id" class="form-control" value="{$id}">`);
                        $("#group").append(`<img class="mt-2" width="80px" src="../uploads/{$image}" alt="">`);
                    JS;
                }
            ?>
        } else {
          
            
            $("#title").text("Add Product");
            $("#save").show();
            $("#edit").hide();
        }
    });
</script>

   
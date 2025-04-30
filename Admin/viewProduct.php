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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</head>
<style>
    .dashboard {
            display: flex;
            min-height: 100vh;
        }
        .list {
            margin-left: 250px;
            padding: 25px;
            
        }
</style>
<body>
    <div class="dashboard">
        <?php
            include 'sidebar.php';
        ?>
        <div class="list">
            <h1>List Products</h1>
            <table class="table align-middle text-center" style="table-layout: fixed;">
                <thead>
                    <tr>
                        <th>CODE</th>
                        <th>NAME</th>
                        <th>REQULAR PRICE</th>
                        <th>SALE PRICE</th>
                        <th>IMAGE</th>
                        <th>ADMIN</th>
                        <th>UPDATE AT</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                
                        include '../connection.php';
                        $sql="SELECT *,`profile` FROM `crud_menu` INNER JOIN `crud_user` ON `userID`=`user_id`";
                        $result=$con->query($sql);
                        while($row=$result->fetch_assoc()){
                            echo '
                                <tr>

                                    
                                    <td>'.$row['menu_id'].'</td>
                                    <td>'.$row['menu_name'].'</td>
                                    <td>'.$row['reqular_price'].'</td>
                                    <td>'.$row['sale_price'].'</td>
                                    <td><img width="80" src="../uploads/'.$row['image'].'" alt=""></td>
                                    <td><img width="80" src="../uploads/'.$row['profile'].'" alt=""></td>
                                    <td>'.$row['update_at'].'</td>
                                    <td>
                                        <a style="text-decoration: none; color:#fff;" href="add-product.php?id='.$row['menu_id'].'" > <button class="btn btn-warning">Edit</button></a>
                                        <button class="btn btn-danger" name="btnDelete" data-id="'.$row['menu_id'].'"  data-bs-toggle="modal" data-bs-target="#exampleModal1" id="btnDelete">Delete</button>
                                    </td>
                                </tr>
                            ';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this product?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
           <form action="function.php" method="post">
            <input type="hidden" name="hide_id" id="hide_id">
            <button class="btn btn-primary me-2" name="delete">Yes delete.</button>
            <button  data-bs-dismiss="modal" type="button" class="btn btn-danger">Cancel</button>
           </form>             
      </div>
    </div>
  </div>
</div>
</body>
</html>
<script>
    $(document).ready(function(){
        $(document).on('click','#btnDelete',function(){
            var id=$(this).attr('data-id');
            $('#hide_id').val(id);
        })
    })
</script>
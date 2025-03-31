<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
              <h1>Add Product</h1> 
              <form action="" method="post" enctype="multipart/form-data">
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
                    <div class="form-group">
                        <label for="Image" class="form-label">Image</label>
                        <input type="file" name="Image" id="Image" class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary mt-3 me-2">Save</button>
                        <button class="btn btn-danger mt-3 me-3">Cancel</button>
                    </div>
              </form> 
         </div> 
    </div>
</body>
</html>
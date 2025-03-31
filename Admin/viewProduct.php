<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
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
                    <tr>
                        <td>1</td>
                        <td>Coca</td>
                        <td>2000</td>
                        <td>2000</td>
                        <td><img width="80" src="https://cdn.s-liquor.com.kh/sliquors3/wp-content/uploads/2020/07/1681925010.jpg?strip=all&lossy=1&webp=85&avif=80&ssl=1" alt=""></td>
                        <td><img width="80" src="https://i.pinimg.com/736x/20/93/3c/20933c271a9a88fdf161076b1ace17be.jpg" alt=""></td>
                        <td>12/2/2025</td>
                        <td>
                            <button class="btn btn-warning">Edit</button>
                            <button class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
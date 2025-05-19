<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Ajax</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
    *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }
    #img:hover{
        cursor: pointer;
    }
</style>
<body>
    <div class="container-fluid pt-5">
        <h3>Clothes` Stock</h3>
        <button class="btn btn-primary float-end"  data-bs-toggle="modal" data-bs-target="#exampleModal" id="btnAdd">Add Stock</button>
        <table class="mt-5 table text-center align-middle" style="table-layout: fixed;">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Reqular Price</th>
                    <th>Sale Price</th>
                    <th>Stock</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <?php 
                    include "connection.php";
                    global $con;
                    $select="SELECT * FROM `tbproduct` ORDER BY `id` DESC";
                    $res=$con->query($select);
                    while($row=$res->fetch_assoc()){
                        echo '
                        <tr>
                            <td>'.$row['id'].'</td>
                            <td>'.$row['name'].'</td>
                            <td>'.$row['r_price'].'</td>
                            <td>'.$row['s_price'].'</td>
                            <td>'.$row['stock'].'</td>
                            <td>'.$row['size'].'</td>
                            <td>'.$row['color'].'</td>
                            <td>'.$row['description'].'</td>
                            <td><img width="80" src="./uploads/'.$row['image'].'" alt=""></td>
                            <td>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal" id="btnEdit">Edit</button>
                                <button type="button" class="btn btn-danger" data-id="'.$row['id'].'" id="delete"  data-bs-toggle="modal" data-bs-target="#exampleModal1">Delete</button>
                            </td>
                        </tr>';
                    }
                ?>
            </tbody>
        </table>
        <!-- modal add -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="title"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="hidden" name="hide_id" id="hide_id">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" id="name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="r_price" class="form-label">Reqular Price</label>
                                        <input type="text" name="r_price" id="r_price" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                    <label for="s_price" class="form-label">Sale Price</label>
                                    <input type="text" name="s_price" id="s_price" class="form-control">
                                </div>   
                                </div>
                                <div class="col-6">
                                <div class="form-group">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" min="1" name="stock" id="stock" class="form-control">
                            </div>
                                </div>
                                <div class="col-6">
                                <div class="form-group">
                                <label for="size" class="form-label">Size</label>
                                <select name="size[]" id="size" class="form-select" multiple>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                </select>
                            </div>
                                </div>
                                <div class="col-6">
                                <div class="form-group">
                                <label for="color" class="form-label">Color</label>
                                <select name="color[]" id="color" class="form-select" multiple>
                                    <option value="Red">Red</option>
                                    <option value="Blue">Blue</option>
                                    <option value="Yellow">Yellow</option>
                                    <option value="Green">Green</option>
                                    <option value="Black">Black</option>
                                    <option value="White">White</option>
                                    <option value="Pink">Pink</option>
                                    <option value="Orange">Orange</option>  
                                </select>
                            </div>
                                </div>
                                <div class="col-12">
                                <div class="form-group">
                                <label for="des" class="form-label">Description</label>
                                <textarea name="des" id="des" class="form-control"></textarea>
                            </div>
                                </div>
                                <div class="col-12">
                                <div class="form-group  d-flex flex-column">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" id="image" class="form-control"> 
                                <input type="text" name="name_image" id="name_image" class="form-control"> 
                                <img id="img"  width="120px" src="https://ralfvanveen.com/wp-content/uploads/2021/06/Placeholder-_-Glossary.svg" alt="">
                            </div>
                                </div>
                                <div class="col-12">
                                <div class="form-group mt-3">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" name="save" id="save">Save</button>
                                <button type="button" class="btn btn-warning" data-bs-dismiss="modal" name="edit" id="edit">Edit</button>
                            </div>
                                </div>
                            </div>    
                            
                        </form>
                    </div>
                    
                </div>   
            </div>
        </div>
    </div>
    <!-- modal delete -->
     <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this product?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
            <input type="hidden" name="hide_id" id="hide_id">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="btnDelete">Yes, delete it.</button>
        </form>
      </div>
      
        
    
    </div>
  </div>
</div>
</body>
</html>
<script>
    
  const size = new Choices('#size', {
    removeItemButton: true,
   // only one visible, but still allows multiple
    placeholderValue: 'Select size',
    duplicateItemsAllowed: true,
  });
  const color = new Choices('#color', {
    removeItemButton: true,
   // only one visible, but still allows multiple
    placeholderValue: 'Select color',
    duplicateItemsAllowed: true,
  });
  $(document).ready(function(){
    $('#image').hide();
    $('#img').click(function(){
        $('#image').click();
    })
    $('#image').change(function(){
        const form_data=new FormData();
        const file=this.files[0]; 
        form_data.append('image',file);
        $.ajax({
            url:'moveFile.php',
            method:"POST",
            data:form_data,
            contentType:false,
            processData: false,
            cache:false,
            success:function(res){
                 $('#img').attr('src','uploads/'+res+'');
                 $('#name_image').val(res);
            }
        });
    })
    $('#save').click(function(){
        const name=$('#name').val();
        const r_price=$('#r_price').val();
        const s_price=$('#s_price').val();
        const stock=$('#stock').val();
        const size=$('#size').val();
        const color=$('#color').val();
        const des=$('#des').val();
        const name_image=$('#name_image').val();
        $.ajax({
            url:'insert.php',
            method:'post',
            data:{
               'name':name, 
               'r_price':r_price, 
               's_price':s_price, 
               'stock':stock, 
               'size':size, 
               'color':color, 
               'des':des, 
               'name_image':name_image, 
            },
            cache:false,
            success:function(res){
                $('#tbody').prepend(`'
                    <tr>
                    <td>${res}</td>
                    <td>${name}</td>
                    <td>${r_price}</td>
                    <td>${s_price}</td>
                    <td>${stock}</td>
                    <td>${size}</td>
                    <td>${color}</td>
                    <td>${des}</td>
                    <td><img width="80" src="./uploads/${name_image}" alt=""></td>
                    <td>
                        <button class="btn btn-warning " id="btnEdit" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
                        <button class="btn btn-danger" type="button" data-id="${res}" id="delete"  data-bs-toggle="modal" data-bs-target="#exampleModal1">Delete</button>
                    </td>
                </tr>
                `)   
            }
        });
        
    })
    //  hide id
    
    $(document).on('click','#delete',function(){
        var hide_id=$(this).attr('data-id');
        $('#hide_id').val(hide_id);
        const row=$(this).parents('tr');
        
        $('#btnDelete').click(function(){
        var id=$('#hide_id').val();
               
        $.ajax({
            url:'delete.php',
            method:'POST',
            data:{
                hide_id:id
            },
            cache:false,
            success:function(res){
                if(res=="Success"){
                    row.remove();
                }
                
            }
        });
        
        })
    })
    $('#btnAdd').click(function(){
        $('#title').html("Add Stock");
        $('#edit').hide();
        $('#save').show()
    })
    $(document).on('click','#btnEdit',function(){
        $('#title').html("Edit Stock");
        $('#edit').show();
        $('#save').hide();
        let row=$(this).parents('tr');  
        //get data from table
        const code=row.find('td').eq(0).text();
        const name=row.find('td').eq(1).text()
        const r_price=row.find('td').eq(2).text()
        const s_price=row.find('td').eq(3).text()
        const stock=row.find('td').eq(4).text()       
        const des=row.find('td').eq(7).text()
        const image_name=row.find('img').attr('src').split('/').pop();     
        //take data insert into form
        $('#hide_id').val(code);
        $('#name').val(name);
        $('#r_price').val(r_price);
        $('#s_price').val(s_price);
        $('#stock').val(stock);
        $('#des').val(des);
        $('#des').val(des);
        $('#name_image').val(image_name);
        $('#img').attr('src','uploads/'+image_name+'');
        
        $('#edit').click(function(){
            const f_code=$('#hide_id').val();
            const f_name=$('#name').val();
            const f_r_price=$('#r_price').val();
            const f_s_price=$('#s_price').val();
            const f_stock=$('#stock').val();
            const f_des=$('#des').val();
            const f_size=$('#size').val();
            const color=$('#color').val();
            const name_image=$('#name_image').val();  
            $.ajax({
                url:'editProduct.php',
                method:'post',
                data:{
                    'code':f_code,
                    'name':f_name, 
                    'r_price':f_r_price, 
                    's_price':f_s_price, 
                    'stock':f_stock, 
                    'size':f_size, 
                    'color':color, 
                    'des':f_des, 
                    'name_image':name_image, 
                },
            cache:false,
            success:function(res){              
                    $(row).html(`'    
                    <td>${code}</td>
                    <td>${name}</td>
                    <td>${r_price}</td>
                    <td>${s_price}</td>
                    <td>${stock}</td>
                    <td>${f_size}</td>
                    <td>${color}</td>
                    <td>${des}</td>
                    <td><img width="80" src="./uploads/${res}" alt=""></td>
                    <td>
                        <button class="btn btn-warning " id="btnEdit" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
                        <button class="btn btn-danger" type="button" data-id="${res}" id="delete"  data-bs-toggle="modal" data-bs-target="#exampleModal1">Delete</button>
                    </td>
                
                `)
            }
        });
        })
        
    })
    
  })
</script>

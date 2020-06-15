<?php include 'inc/header.php';?>
<?php 
    include 'inc/sidebar.php';
    include '../classes/category.php';
    include '../classes/brand.php';
    include '../classes/product.php';
?>
<?php
    if(!isset($_GET['proId']) || $_GET['proId'] == null){
        echo "<script>window.location = 'productlist.php' </script>";
    }
    else {
        $id = $_GET['proId'];
    }
    // Khoi tao object product
    $product = new product();
    $cat = new category;
    $brand = new brand;
    // Khi user nhan update cap nhat thong tin product
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $updatePro = $product->update_product($_POST, $_FILES , $id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
            <h2>Edit Product</h2>
            <div class="block">             
                <?php
                    if(isset($updatePro)){
                        echo $updatePro;
                    }
                ?>  
                <?php 
                    if($productShow = $product->get_pro_byId($id)){   
                        while($row = mysqli_fetch_assoc($productShow)){
                ?>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="productName" value="<?php echo $row['productName']?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="category">
                                <option>-------Select Category-------</option>
                                <?php
                                    if($categoryShow = $cat->show_category()){
                                        while($row2 = $categoryShow->fetch_assoc()){
                                ?>
                                <option value="<?php echo $row2['catId']?>" <?php if($row['catId'] == $row2['catId']) echo "selected"?>><?php echo $row2['catName']?></option>
                                <?php
                                        }
                                    }
                                ?>
                                <!-- <option value="2">Category Two</option>
                                <option value="3">Category Three</option> -->
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Brand</label>
                        </td>
                        <td>
                            <select id="select" name="brand">
                                <option>-------Select Brand-------</option>
                                <?php
                                    $brandShow = $brand->show_brand();
                                    if($brandShow){
                                        while($result = $brandShow->fetch_assoc()){
                                ?>
                                <option value="<?php echo $result['brandId']?>" <?php if($row['brandId'] == $result['brandId']) echo "selected"?>><?php echo $result['brandName']?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Description</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="descr"><?php echo $row['descr']?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Price</label>
                        </td>
                        <td>
                            <input type="text" name="price" value="<?php echo $row['price']?>" class="medium" />
                        </td>
                    </tr>
                
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input name="image" type="file" />
                            <img src="<?php echo "uploads/".$row['image']?>" style="width:90px; margin-top:20px"/>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label>Product Type</label>
                        </td>
                        <td>
                            <select id="select" name="type">
                                <option>Select Type</option>
                                <?php
                                    if($row['type'] == 1){
                                ?>
                                    <option value="1" selected>Featured</option>
                                    <option value="0" >Non-Featured</option>
                                <?php
                                    }else{
                                ?>
                                    <option value="1">Featured</option>
                                    <option value="0" selected>Non-Featured</option>
                                <?php
                                    }
                                ?>

                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
                </form>
                <?php
                        }
                    }
                ?>
            </div>
            </div>
        </div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>
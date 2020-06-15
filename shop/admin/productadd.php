﻿<?php 
    include 'inc/header.php';    
    include 'inc/sidebar.php';
    include '../classes/category.php';
    include '../classes/brand.php';
    include '../classes/product.php'
?>
<?php
    $cat = new category;
    $brand = new brand;
?>

<?php
    $pro = new product;

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // $catName = $_POST['catName'];
        $insertPro = $pro->insert_product($_POST,$_FILES);
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">             
        <?php
            if(isset($insertPro)){
                echo $insertPro;
            }
        ?>  
         <form action="productadd.php" method="post" enctype="multipart/form-data">
            <table class="form">
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" placeholder="Enter Product Name..." class="medium" />
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
                                    while($row = $categoryShow->fetch_assoc()){
                            ?>
                            <option value="<?php echo $row['catId']?>"><?php echo $row['catName']?></option>
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
                            <option value="<?php echo $result['brandId']?>"><?php echo $result['brandName']?></option>
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
                        <textarea class="tinymce" name="descr"></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" placeholder="Enter Price..." class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input name="image" type="file" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <option value="1">Featured</option>
                            <option value="0
                            
                            
                            
                            ">Non-Featured</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
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



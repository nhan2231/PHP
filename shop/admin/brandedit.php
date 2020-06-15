<?php include 'inc/header.php';?>
<?php 
    include 'inc/sidebar.php';
    include '../classes/brand.php';
?>
<?php
    if(!isset($_GET['brandId']) || $_GET['brandId'] == null){
        echo "<script>window.lobrandion = 'brandlist.php' </script>";
    }
    else {
        $id = $_GET['brandId'];
    }
?>
<?php
    $brand = new brand();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $brandName = $_POST['brandName'];
        $updateBrand = $brand->update_brand($brandName, $id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Brand's Name</h2>
                <?php
                    if(isset($updateBrand)){
                        echo $updateBrand;
                    }
                ?>
                
               <div class="block copyblock"> 
               <?php
                    $getbrandeName = $brand->get_brand_byId($id);         
                    if($getbrandeName){
                        while($result = $getbrandeName->fetch_assoc()){
                ?>
                 <form action='' method='post'>
                    <table class="form">			
                        <tr>
                            <h4>Brand's Name: <?php echo '<span style="color: grey">'.$result['brandName'].'</span>'?></h4>
                            <td>
                                <input type="text" name="brandName" placeholder="Enter Brand's New Name..." class="medium" />
                            </td>
                        </tr>
						<tr>
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
<?php include 'inc/footer.php';?>
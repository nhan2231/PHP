<?php include 'inc/header.php';?>
<?php 
    include 'inc/sidebar.php';
    include '../classes/category.php';
?>
<?php
    if(!isset($_GET['catId']) || $_GET['catId'] == null){
        echo "<script>window.location = 'catlist.php' </script>";
    }
    else {
        $id = $_GET['catId'];
    }
    $cat = new category();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $catName = $_POST['catName'];
        $updateCat = $cat->update_category($catName, $id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Category</h2>
                <?php
                    if(isset($updateCat)){
                        echo $updateCat;
                    }
                ?>
                
               <div class="block copyblock"> 
               <?php
                    $getCateName = $cat->get_cat_byId($id);         
                    if($getCateName){
                        while($result = $getCateName->fetch_assoc()){
                ?>
                 <form action='' method='post'>
                    <table class="form">			
                        <tr>
                            <h4>Category's Name: <?php echo '<span style="color: grey">'.$result['catName'].'</span>'?></h4>
                            <td>
                                <input type="text" name="catName" placeholder="Enter Category's New Name..." class="medium" />
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
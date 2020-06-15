<?php
    $filepath = realpath(dirname(__DIR__));
    require_once $filepath.'../libs/database.php';
    require_once $filepath.'../helpers/format.php';
?>

<?php
    class product  
    {
        // Khoi tao bien ket noi du lieu va bien kiem tra form
        private $db;
        private $fm;
        
        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        // Chuc nang dang nhap admin
        public function insert_product($data, $files){
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $descr = mysqli_real_escape_string($this->db->link, $data['descr']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']); 
            $type = mysqli_real_escape_string($this->db->link, $data['type']);  
            
            // Kiem tra hinh anh va luu vao file upload
            $permited = array('jpg','jpeg','png','gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];
            
            $div = explode('.',$file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $uploaded_image = "uploads/" . $unique_image;

            if(empty($productName) || empty($brand) || empty($category) || empty($type) || empty($price) || empty($descr) || empty($file_name)){
                return "<span class='error'>Fields can't be empty</span>";
            }
            else{
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO tbl_product(productName, brandId, catId, descr, type, price, image) VALUES ('$productName','$brand','$category',
                    '$descr','$type','$price','$unique_image')";
                $result = $this->db->insert($query);
                
                if($result){
                    return '<span class="success"> Successfully insert Product</span>';
                } 
                else{
                    return "<span class='error'>Product can't be insert</span>";
                }
            }
        }
        // Lay danh sach cac san pham
        public function show_product(){
            $query =  'SELECT * FROM tbl_product ORDER BY productId asc';
            $result = $this->db->select($query);
            return $result;
        }

        //Lay danh sach san pham kem catName va brandName
        // private $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
        //                 FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 
        //                 INNER JOIN tbl_brand ON tbl_prodcut.brandId = tbl_brand.brandId
        //                 ORDER BY productId DESC";

        // Lay category của san pham theo productId
        public function get_cat_byproId($id){
            $query = "SELECT catName FROM tbl_category WHERE catId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        
        // Lay brand cua san pham theo produdctId
        public function get_brand_byproId($id){
            $query = "SELECT brandName FROM tbl_brand WHERE brandId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        
        // Lay product theo id
        public function get_pro_byId($id){
            $id = intval($id);
            $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
            return $this->db->select($query);
        }

        // Update thong tin san pham
        public function update_product($data, $files, $id){
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $descr = mysqli_real_escape_string($this->db->link, $data['descr']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']); 
            $type = mysqli_real_escape_string($this->db->link, $data['type']);
            $id = mysqli_real_escape_string($this->db->link, $id);  
            
            // Kiem tra hinh anh va luu vao file upload
            $permitted = array('jpg','jpeg','png','gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];
            
            $div = explode('.',$file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $uploaded_image = "uploads/" . $unique_image;

            if(empty($productName) || empty($brand) || empty($category) || strlen($type) < 1 || empty($price) || empty($descr)){
                return "<span class='error'>Fields can't be empty</span>";
            }
            else{
                // Truong hop nguoi dung thay doi anh san pham
                if(!empty($file_name)){
                    if ($file_size > 2000000 ){
                        return "<span style='color: red'>Your image's size can't be bigger than 2MB, your file " . $file_size . "KB</span>";
                    }
                    else if(in_array($file_ext, $permitted) == false){
                        return "<span style='color: red'>You can upload only.". implode(', ', $permitted) ."</span>";
                    }
                    // Anh san pham duoc upload len hop le
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE tbl_product SET 
                        `productName` = '$productName',
                        `catId` = '$category',
                        `brandId` = '$brand',
                        `descr` = '$descr',
                        `type` = '$type',
                        `price` = '$price',
                        `image` = '$unique_image'

                        WHERE `productId` = '$id'";
                }
                // Truong hop nguoi su dung khong thay doi anh san pham
                else{
                    $query = "UPDATE tbl_product SET 
                            `productName` = '$productName',
                            `catId` = '$category',
                            `brandId` = '$brand',
                            `descr` = '$descr',
                            `type` = '$type',
                            `price` = '$price'
                            WHERE `productId` = '$id'";
                }

                $result = $this->db->update($query);
    
                if($result){
                    return '<span class="success"> Successfully Update Product</span>';
                } 
                else{
                    return "<span class='error'>Update failed</span>";
                }
            }   
        }

        public function delete_pro($id){
            $id = intval($id);
            $query = "DELETE FROM tbl_product WHERE productId = ' $id'";
            $result = $this->db->delete($query);
            if($result){
                echo '<h3 style="color: green; font-size: 18px">Item has been deleted</h3>';
            }
            else{
                echo '<h3 style="color: red; font-size: 18px">Error in deleting item</h3>';
            }
        }

        public function featured_product(){
            $query = "SELECT * FROM tbl_product WHERE type = '1'";
            return $result = $this->db->select($query);
        }

        public function new_product(){
            $query = "SELECT * FROM tbl_product ORDER BY productId desc LIMIT 4";
            return $result = $this->db->select($query);
        }

        function get_detail($id){
            $query =   "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
                        FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 
                        INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId WHERE productId = '$id' LIMIT 1";
            return $this->db->select($query);
        }

        function hot_product(){
            // $query =    "SELECT *, count (productName) as `times` 
            //             FROM tbl_order GROUP BY productName ORDER BY `times` desc LIMIT 2";
            $query = "SELECT * FROM tbl_order GROUP BY productId ORDER BY count(productId) DESC LIMIT 4";
            return $this->db->select($query);
        }

        function list_by_brand($brand){
            $brand = $brand."";
            $query = "SELECT * FROM tbl_product WHERE brandId = '$brand' LIMIT 4";
            return $this->db->select($query);
        }

        function find_product($key){
            $key = $this->db->link->real_escape_string($key);
            if($key != ''){
                $qr = "SELECT * FROM tbl_product WHERE productName LIKE '%$key%' ";
                $result = $this->db->select($qr);
                if($result != false){
                    while($row = $result->fetch_assoc()){
                        echo "<a href=details.php?proId=".$row['productId'].">".$row['productName']."</a><br>";
                    }
                };
            }
            
            // return $this->db->select($qr);
        }

        function list_category($catId){
            $query = "SELECT * FROM tbl_product WHERE catId = '$catId'";
            return $this->db->select($query);
        }
    }
?>

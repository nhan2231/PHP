<?php
    require_once '../libs/database.php';
    require_once '../helpers/format.php';
?>

<?php
    class brand
    {
        // Khoi tao bien ket noi du lieu va bien kiem tra form
        private $db;
        private $fm;
        
        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        // Chuc nang dang nhap admin
        public function insert_brand($brandName){
            $brandName = $this->fm->validation($brandName);

            $brandName = mysqli_real_escape_string($this->db->link, $brandName);

            if(empty($brandName)){
                return "<span class='error'>Brand's name can't be empty</span>";
            }
            else{
                $query = "INSERT INTO tbl_brand (brandName) VALUES ('$brandName')";
                $result = $this->db->insert($query);
                
                if($result){
                    return '<span class="success"> Successfully insert Brand</span>';
                } 
                else{
                    return "<span class='error'>Brand can't be insert</span>";
                }
            }
        }

        public function show_brand(){
            $query =  'SELECT * FROM tbl_brand ORDER BY brandId desc';
            $result = $this->db->select($query);
            return $result;
        }

        public function get_brand_byId($id){
            $id = intval($id);
            $query = "SELECT * FROM tbl_brand WHERE brandId = ('$id')";
            return $this->db->select($query);
        }

        public function update_brand($brandName, $id){
            $brandName = $this->fm->validation($brandName);
            $brandName = mysqli_real_escape_string($this->db->link, $brandName);
            $id = $this->db->link->real_escape_string($id);

            if(empty($brandName)){
                return "Brand's name cannot be empty";
            }
            else{
                $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = '$id'";
                $result = $this->db->update($query);
                if($result){
                    return "<span style='color: green'>Update brand's name successfully</span>";
                }
                else{
                    return "<span style='color: red'>Update fail</span>";
                }
            }
        }

        public function delete_brand($id){
            $id = intval($id);
            $query = "DELETE FROM tbl_brand WHERE brandId = ' $id'";
            $result = $this->db->delete($query);
            if($result){
                echo '<h3 style="color: green; font-size: 18px">This brand has been deleted</h3>';
            }
            else{
                echo '<h3 style="color: red; font-size: 18px">Error in deleting brand</h3>';
            }
        }

    }
?>

<?php
    $filepath = realpath(dirname(__DIR__));
    require_once $filepath.'../libs/database.php';
    require_once $filepath.'../helpers/format.php';
?>

<?php
    class category
    {
        // Khoi tao bien ket noi du lieu va bien kiem tra form
        private $db;
        private $fm;
        
        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        // Chuc nang dang nhap admin
        public function insert_category($catName){
            $catName = $this->fm->validation($catName);

            $catName = mysqli_real_escape_string($this->db->link, $catName);

            if(empty($catName)){
                return "<span class='error'>Category can't be empty</span>";
            }
            else{
                $query = "INSERT INTO tbl_category(catName) VALUES ('$catName')";
                $result = $this->db->insert($query);
                
                if($result){
                    return '<span class="success"> Successfully insert category</span>';
                } 
                else{
                    return "<span class='error'>Category can't be insert</span>";
                }
            }
        }

        public function show_category(){
            $query =  'SELECT * FROM tbl_category ORDER BY catId desc';
            $result = $this->db->select($query);
            return $result;
        }

        public function get_cat_byId($id){
            $id = intval($id);
            $query = "SELECT * FROM tbl_category WHERE catId = ('$id')";
            return $this->db->select($query);
        }

        public function update_category($catName, $id){
            $catName = $this->fm->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link, $catName);
            $id = $this->db->link->real_escape_string($id);

            if(empty($catName)){
                return "Category's name cannot be empty";
            }
            else{
                $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$id'";
                $result = $this->db->update($query);
                if($result){
                    return "<span style='color: green'>Update category's name successfully</span>";
                }
                else{
                    return "<span style='color: red'>Update fail</span>";
                }
            }
        }

        public function delete_category($id){
            $id = intval($id);
            $query = "DELETE FROM tbl_category WHERE catId = ' $id'";
            $result = $this->db->delete($query);
            if($result){
                echo '<h3 style="color: green; font-size: 18px">Item has been deleted</h3>';
            }
            else{
                echo '<h3 style="color: red; font-size: 18px">Error in deleting item</h3>';
            }
        }

    }
?>

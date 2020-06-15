<?php
    $filepath = realpath(dirname(__DIR__));
    require_once $filepath.'../libs/database.php';
    require_once $filepath.'../helpers/format.php';
?>

<?php
    class Cart
    {
        // Khoi tao bien ket noi du lieu va bien kiem tra form
        private $db;
        private $fm;
        
        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        function add_to_cart($quantity, $id){
            // Lay cac gia tri can thiet
            $quantity = $this->fm->validation($quantity);
            $quantity = $this->db->link->real_escape_string($quantity);
            $id = $this->db->link->real_escape_string($id);
            $sId = session_id();
            
            // Kiem tra xem san pham da ton tai trong gio hang chua
            $checkDuplicate = "SELECT quantity FROM tbl_cart WHERE `sId`='$sId' AND `productId` = '$id'";
            $output = $this->db->select($checkDuplicate)->num_rows;

            // Neu san pham da co trong gio hang
            if($output > 0){
                $getQt = $this->db->select($checkDuplicate)->fetch_assoc();
                $qtUpdate = $quantity + $getQt['quantity'];
                $query = "UPDATE tbl_cart Set quantity = '$qtUpdate' WHERE `sId`='$sId' AND `productId` = '$id'";
                $result = $this->db->update($query);
                if($result){
                    header('Location:cart.php');
                }
                else{
                    header('Location:404.php');;
                }
            }
            // San pham chua co trong gio hang
            else{
                $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
                $row = $this->db->select($query)->fetch_assoc();
                $productName = $row['productName'];
                $price = $row['price'];
                $image = $row['image'];

                $query =   "INSERT INTO tbl_cart (productId, sId, productName, price, quantity, image)
                            VALUES ('$id', '$sId', '$productName', '$price','$quantity', '$image')";
                $result = $this->db->insert($query);
                if($result){
                    header('Location:cart.php');
                }
                else{
                    header('Location:404.php');;
                }
            }
            
        }

        function get_item(){
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE `sId` = '$sId'";
            $output = $this->db->select($query);
            return $output;
        }

        function update_cart($quantity, $cartId){
            $query = "UPDATE tbl_cart SET `quantity` = '$quantity' WHERE `cartId` = '$cartId' ";
            $update = $this->db->update($query);
            if($update){
                header('Location:cart.php');
            }
        }

        function del_cart($id){
            $query = "DELETE FROM tbl_cart WHERE cartId = '$id' ";
            $update = $this->db->delete($query);
            if($update){
                header('Location:cart.php');
            }
        }

        function del_all_data_cart(){
            $sId = session_id();
            $query = "DELETE FROM tbl_cart WHERE sId = '$sId' ";
            $result = $this->db->delete($query);
            return $result;
        }

        //
        function insert_order($customer_id){
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId = '$sId' ";
            $get_product = $this->db->select($query);
            if($get_product){
                while($result = $get_product->fetch_assoc()){
                    $productId = $result['productId'];
                    $productName = $result['productName'];
                    $quantity = $result['quantity'];
                    $price = $result['price'];
                    $image = $result['image'];

                    $query_order =   "INSERT INTO tbl_order(productId, productName, price, quantity, image, customer_id)
                    VALUES ('$productId', '$productName', '$price','$quantity', '$image', '$customer_id')";
                    $insert_order = $this->db->insert($query_order);
                }
            }
        }
        //
        function get_ordered_item(){
            $id = session::get('customer_id');
            $query = "SELECT * FROM tbl_order WHERE `customer_id` = '$id' ";
            $result = $this->db->select($query);
            return $result;
        }

        function order_check(){
            $id = session::get('customer_id');
            if($id){
                $query = "SELECT * FROM tbl_order WHERE customer_id = '$id'";
                return $this->db->select($query);
            }
           return false;
        }
        //
        function get_inbox_cart(){
            $query = "SELECT * FROM tbl_order ORDER BY date";
            $get_inbox_cart = $this->db->select($query);
            return $get_inbox_cart; 
        }
    }
?>

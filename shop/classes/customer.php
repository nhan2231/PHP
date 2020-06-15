<?php
    $filepath = realpath(dirname(__DIR__));
    require_once $filepath.'../libs/database.php';
    require_once $filepath.'../helpers/format.php';
?>

<?php
    class Customer
    {
        // Khoi tao bien ket noi du lieu va bien kiem tra form
        private $db;
        private $fm;
        
        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        function insert_customer($data){
            $name = $this->db->link->real_escape_string($data['name']);
            $address = $this->db->link->real_escape_string($data['address']);
            $city = $this->db->link->real_escape_string($data['city']);
            $country = $this->db->link->real_escape_string($data['country']);
            $zipcode = $this->db->link->real_escape_string($data['zipcode']);
            $phone = $this->db->link->real_escape_string($data['phone']);
            $email = $this->db->link->real_escape_string($data['email']);
            $password = $this->db->link->real_escape_string($data['password']);

            if(empty($name) || empty($address) || empty($city) || empty($country) || empty($zipcode) || empty($phone) || empty($email) || empty($password)){
                return "<span style='color:red; font-size:18px'>Fields can't be empty</span>";
            }
            else{
                // check email dang ky cua khach hang
                $checkEmail = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
                $result = $this->db->select($checkEmail);
                if($result){
                    return "<span style='color:red'>This email address has been taken! Please use another one</span>";
                }
                // Neu email chua co nguoi su dung
                else{
                    $query = "INSERT INTO tbl_customer(`name`,`address`,`city`,`country`,`zipcode`,`phone`,`email`,`password`) VALUES 
                            ('$name','$address','$city','$country','$zipcode','$phone','$email','$password')";
                    $row = $this->db->insert($query);
                    if($row){
                        return "<span style'color:green'>User has been created</span>";
                    }
                    else{
                        return "<span style'color:red'>Error in creating new user</span>";
                    }
                }
            }
        }
        
        function login_customer($data){
            $email = $this->db->link->real_escape_string($data['email']);
            $password = $this->db->link->real_escape_string($data['password']);
            
            if(empty($email) || empty($password)){
                return "<span style='color:red; font-size:18px'>Fields can't be empty</span>";
            }
            else{
                $checkUser = "SELECT * FROM tbl_customer WHERE `email` = '$email' AND `password` = '$password' LIMIT 1";
                $result = $this->db->select($checkUser);
                if($result != false){
                    $row = $result->fetch_assoc();
                    Session::set('customer_login', true);
                    Session::set('customer_id', $row['id']);
                    Session::set('customer_name', $row['name']);
                    header('Location:index.php');
                }
                else{
                    return "<span style='color:red'>Wrong username or password</span>";
                }
            }
        }

        function show_customer($id){
            $query = "SELECT * FROM tbl_customer WHERE id = '$id' ";
            $result = $this->db->select($query);
            return $result;
        }

        function update_customer($data, $id){
            $name = $this->db->link->real_escape_string($data['name']);
            $address = $this->db->link->real_escape_string($data['address']);
            $city = $this->db->link->real_escape_string($data['city']);
            $country = $this->db->link->real_escape_string($data['country']);
            $zipcode = $this->db->link->real_escape_string($data['zipcode']);
            $phone = $this->db->link->real_escape_string($data['phone']);
            $email = $this->db->link->real_escape_string($data['email']);

            if(empty($name) || empty($address) || empty($city) || empty($country) || empty($zipcode) || empty($phone) || empty($email)){
                return "<span style='color:red; font-size:18px'>Fields can't be empty</span>";
            }
            else{
                // check email dang ky cua khach hang
                $query =    "UPDATE tbl_customer SET 
                            name = '$name',
                            address = '$address',
                            city = '$city',
                            country = '$country',
                            zipcode = '$zipcode',
                            phone = '$phone',
                            email = '$email'

                            WHERE id = '$id' ";
                $result = $this->db->update($query);
                if($result){
                    return "<span style='color:green'>Update successfully</span>";
                }
                else{
                    return "<span style'color:red'>Error in updating user</span>";
                }
            }
        }

    }
?>

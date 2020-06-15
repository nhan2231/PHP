<?php
    $filepath = realpath(dirname(__DIR__));
    include $filepath.'../libs/session.php';
    Session::checkLogin();
    include $filepath.'../libs/database.php';
    include $filepath.'../helpers/format.php';
?>

<?php
    class adminlogin
    {
        // Khoi tao bien ket noi du lieu va bien kiem tra form
        private $db;
        private $fm;
        
        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        // Chuc nang dang nhap admin
        public function login_admin($adminUser, $adminPass){
            $adminUser = $this->fm->validation($adminUser);
            $adminPass = $this->fm->validation($adminPass);

            $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
            $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

            if(empty($adminUser) || empty($adminPass)){
                return "Username and password can not be empty";
            }
            else{
                $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' LIMIT 1";
                $result = $this->db->select($query);
                
                if($result != false){
                    $value = $result->fetch_assoc();
                    Session::set('login',true);
                    Session::set('adminId', $value['adminId']);
                    Session::set('adminName', $value['adminName']);
                    Session::set ('adminUser', $value['adminUser']);
                    Session::set('adminPass', $value['adminPass']);
                    header('Location:index.php');
                } 
                else{
                    return '<span style="color: red">Username and password is not match</span>';
                }
            }
        }
    }
?>

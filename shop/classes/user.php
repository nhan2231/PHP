<?php
    $filepath = realpath(dirname(__DIR__));
    require_once $filepath.'../libs/database.php';
    require_once $filepath.'../helpers/format.php';
?>

<?php
    class User
    {
        // Khoi tao bien ket noi du lieu va bien kiem tra form
        private $db;
        private $fm;
        
        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

    }
?>

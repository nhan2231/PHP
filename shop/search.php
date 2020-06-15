<?php
	require_once 'libs/database.php';
	require_once 'helpers/format.php';
	// Function tu dong include cac class
	spl_autoload_register(function($className){
		include_once "classes/".$className.".php";
	});

	$pd = new product;
?>

<?php
    if(isset($_POST['key'])){
		$key = $_POST['key'];
		$pd->find_product($key);
	}
?>
<?php
	require "../pages/db_config.php";
	$email = filter_var($_GET["email"], FILTER_SANITIZE_EMAIL);
	if ($email == "1@user.com" || $email == "2@user.com" || $email == "3@user.com" || $email == "4@user.com" || $email == "admin@admin.com") {
    	if (!empty($_POST["sin_code"]) && !empty($_POST["jkt_code"]) && !empty($_POST["sup_code"]) && !empty($_POST["name"]) && !empty($_POST["scientific_name"]) && !empty($_POST["chinese_name"]) && !empty($_POST["cost"]) && !empty($_POST["sell"]) && !empty($_POST["quantity"]) && !empty($_POST["size"]) && !empty($_POST["tank"])) {
    		$sin_code = filter_var($_POST["sin_code"], FILTER_SANITIZE_STRING);
    		$jkt_code = filter_var($_POST["jkt_code"], FILTER_SANITIZE_STRING);
    		$sup_code = filter_var($_POST["sup_code"], FILTER_SANITIZE_STRING);
    		$name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    		$scientific_name = filter_var($_POST["scientific_name"], FILTER_SANITIZE_STRING);
    		$chinese_name = filter_var($_POST["chinese_name"], FILTER_SANITIZE_STRING);
    		$cost = filter_var($_POST["cost"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    		$sell = filter_var($_POST["sell"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    		$quantity = filter_var($_POST["quantity"], FILTER_VALIDATE_INT);
    		$size = filter_var($_POST["size"], FILTER_SANITIZE_STRING);
    		$tank = filter_var($_POST["tank"], FILTER_SANITIZE_STRING);
    		
    		$sql = $connect->prepare("INSERT INTO fish_db (sin_code, jkt_code, sup_code, name, scientific_name, chinese_name, cost, sell, quantity, size, tank) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
    		$sql->bind_param("ssssssddiss", $sin_code, $jkt_code, $sup_code, $name, $scientific_name, $chinese_name, $cost, $sell, $quantity, $size, $tank);
    		mysqli_set_charset($connect,"utf8");
    		$sql->execute();
    		
    		echo "<script>alert('Fish has been added')</script>";
    		header("Refresh:0; url= https://sunnyaqm.com/app/pages/addFish.php");
    	} else {
    		echo "<script>alert('Sorry, please provide all the details')</script>";
    		header("Refresh:0; url= https://sunnyaqm.com/app/pages/addFish.php");
    	}
	} else {
	    echo "<script>alert('Sorry, you have to be logged in to do any changes.')</script>";
    	header("Refresh:0; url= https://sunnyaqm.com/app");
	}
?>
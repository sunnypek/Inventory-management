<?php
	$id = filter_var($_GET["fish_id"], FILTER_VALIDATE_INT);
	$email = filter_var($_GET["email"], FILTER_SANITIZE_EMAIL);
	$admin = "admin@admin.com";
	require "../pages/db_config.php";
	if ($email == $admin) {
		$today = date("d-m-Y");
		
		if (!empty($_POST["tank_number"]) && !filter_var($_POST["tank_number"], FILTER_SANITIZE_STRING) === false){
			$tank = filter_var($_POST["tank_number"], FILTER_SANITIZE_STRING);
			$sql_tank = $connect->prepare("UPDATE fish_db SET tank=?, last_updated=? WHERE id=?");
			$sql_tank->bind_param("ssi", $tank, $today, $id);
			$sql_tank->execute();
		}
		if (!empty($_POST["fish_quantity"]) && !filter_var($_POST["fish_quantity"], FILTER_VALIDATE_INT) === false){
			$quantity = filter_var($_POST["fish_quantity"], FILTER_VALIDATE_INT);
			$sql_quantity = $connect->prepare("UPDATE fish_db SET quantity=?, last_updated=? WHERE id=?");
			$sql_quantity-> bind_param("isi", $quantity, $today, $id);
			$sql_quantity->execute();
		} else {
			$quantity = 0;
			$sql_quantity = $connect->prepare("UPDATE fish_db SET quantity=?, last_updated=? WHERE id=?");
			$sql_quantity-> bind_param("isi", $quantity, $today, $id);
			$sql_quantity->execute();
		}
		if (isset($_POST["fish_cost"]) && !filter_var($_POST["fish_cost"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) === false){
			$cost = filter_var($_POST["fish_cost"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			$sql_cost = $connect->prepare("UPDATE fish_db SET cost=?, last_updated=? WHERE id=?");
			$sql_cost->bind_param("dsi", $cost, $today, $id);
			$sql_cost->execute();
		}
		if (isset($_POST["fish_sell"]) && !filter_var($_POST["fish_sell"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) === false){
			$sell = filter_var($_POST["fish_sell"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			$sql_sell = $connect->prepare("UPDATE fish_db SET sell=?, last_updated=? WHERE id=?");
			$sql_sell->bind_param("dsi", $sell, $today, $id);
			$sql_sell->execute();
		}
		mysqli_close($connect);
		echo "<script>alert('Changes made')</script>";
		header("Refresh:0; url= https://sunnyaqm.com/app/pages/fishProfile.php?fish_id={$id}&email={$email}");
	} else {
		mysqli_close($connect);
		echo "<script>alert('Access denied')</script>";
		header("Refresh:0; url=https://sunnyaqm.com/app/pages/fishProfile.php?fish_id={$id}&email={$email}");
	}
?>
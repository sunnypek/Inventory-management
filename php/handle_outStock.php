<?php
	$id = filter_var($_GET["fish_id"], FILTER_VALIDATE_INT);
	$email = filter_var($_GET["email"], FILTER_SANITIZE_EMAIL);
	require "../pages/db_config.php";
	$today = date("d-m-Y");
	if ($email == "1@user.com" || $email == "2@user.com" || $email == "3@user.com" || $email == "4@user.com" || $email == "admin@admin.com") {
    	if (!empty($_POST["quantity"]) && !empty($_POST["po"])){
    		$quantity = filter_var($_POST["quantity"], FILTER_VALIDATE_INT);
    		$po = filter_var($_POST["po"], FILTER_VALIDATE_INT);
    		
    		$query =$connect->prepare("SELECT quantity FROM fish_db WHERE id = ? LIMIT 1");
    		$query->bind_param("i", $id);
    		$query->bind_result($og_quantity);
    		$query->execute();
    		while($query->fetch()) {
    			$value = $og_quantity;
    		}
    		
    		$new_quantity = $value - $quantity;
    		
    		$update_quantity = $connect->prepare("UPDATE fish_db SET quantity=?,last_updated=?,last_exported=? WHERE id=?");
    		$update_quantity->bind_param("issi", $new_quantity, $today, $today, $id);
    		$update_quantity->execute();
    		
    		$out_stock_query = $connect->prepare("INSERT INTO out_stock (fish_id, quantity, po, date, user) VALUES (?, ?, ?, ?, ?)");
    		$out_stock_query->bind_param("iiiss", $id, $quantity, $po, $today, $email);
    		$out_stock_query->execute();
    		
    		mysqli_close($connect);
    		echo "<script>alert('Out stock successful')</script>";
    		header("Refresh:0; url= https://sunnyaqm.com/app/pages/fishProfile.php?fish_id={$id}&email={$email}");
    	} else {
    		mysqli_close($connect);
    		echo "<script>alert('Sorry please provide all the details')</script>";
    		header("Refresh:0; url= https://sunnyaqm.com/app/pages/fishProfile.php?fish_id={$id}&email={$email}");
    	}
	} else {
    	echo "<script>alert('Sorry, you must be logged in to make any changes.')</script>";
    	header("Refresh:0; url= https://sunnyaqm.com/app");
	}
?>
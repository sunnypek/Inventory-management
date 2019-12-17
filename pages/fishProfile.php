<?php
	header('Content-Type: text/html; charset=utf-8');
	require "db_config.php";
	mysqli_set_charset($connect,"utf8");
	$id = filter_var($_GET["fish_id"], FILTER_VALIDATE_INT);
	$query = $connect->prepare("SELECT sin_code, jkt_code, sup_code, chinese_name, cost, last_imported, last_updated, last_exported, name, quantity, scientific_name, sell, size, tank FROM fish_db WHERE id =? LIMIT 1");
	$query->bind_param("i", $id);
	$query->bind_result($sin_code_result, $jkt_code_result, $sup_code_result, $chinese_name_result, $cost_result, $last_imported_result, $last_updated_result, $last_exported_result, $name_result, $quantity_result, $scientific_name_result, $sell_result, $size_result, $tank_result);
	$query->execute();
	while ($query->fetch()){
		$sin_code = $sin_code_result;
		$jkt_code = $jkt_code_result;
		$sup_code = $sup_code_result;
		$chinese_name = $chinese_name_result;
		$cost = $cost_result;
		$last_imported = $last_imported_result;
		$last_updated = $last_updated_result;
		$last_exported = $last_exported_result;
		$name = $name_result;
		$quantity = $quantity_result;
		$scientific_name = $scientific_name_result;
		$sell = $sell_result;
		$size = $size_result;
		$tank = $tank_result;
	}
	/* $query ="SELECT * FROM fish_db WHERE id = {$id} LIMIT 1";
	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_assoc($result); */
	$email = filter_var($_GET["email"], FILTER_SANITIZE_EMAIL);
?>
<!doctype html>
<!--
  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sunny Aquarium Company Dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>SunnyAQM Dashboard</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="../images/android-desktop.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="../images/ios-desktop.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="../images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="images/favicon.png">

    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="http://www.example.com/">
    -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.cyan-light_blue.min.css">
    <link rel="stylesheet" href="../css/styles.css">
		<link rel="stylesheet" href="../css/style.css">

		<script src="../js/jquery-3.1.1.min.js"></script>
  </head>
  <body>
		<!-- <div class="loginCover">
			<div class="mdl-spinner mdl-js-spinner is-active">
			</div>
		</div> -->
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row fishProfileSearch">
          <span class="mdl-layout-title" id="fishProfileName"><?php echo $sin_code ?></span>
          <div class="mdl-layout-spacer"></div>
					<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?fish_id={$id}&email={$email}"); ?> method="POST">
						<div class="mdl-textfield mdl-js-textfield">
							<input class="mdl-textfield__input" type="text" id="sample1" name="search">
							<label class="mdl-textfield__label" for="sample1">Search...</label>
						</div>
					</form>
        </div>
      </header>
      <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
          <img src="../images/user.jpg" class="demo-avatar">
          <div class="demo-avatar-dropdown">
            <span class="signedInEmail"></span>
            <div class="mdl-layout-spacer"></div>
          </div>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
          <a class="mdl-navigation__link" href="home.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Home</a>
          <a class="mdl-navigation__link" href="summary.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">show_chart</i>Summary</a>
					<span onclick='addFish()'><a class="mdl-navigation__link" href="#"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">add</i>Add Fish</a></span>
          <div class="mdl-layout-spacer"></div>
					<a class="mdl-navigation__link" href="#" id='logout'><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">cancel</i>Log out</a>
        </nav>
      </div>
      <main class="mdl-layout__content mdl-color--grey-100 overflow">
				<div class="loginCover">
					<div class="mdl-spinner mdl-js-spinner is-active">
					</div>
				</div>
				<div class="mdl-grid">
					<ul class="mdl-list" id="fishSearch">
					<?php
						if (!empty($_POST["search"]) && 1 === preg_match('~[0-9]~',$_POST["search"]) && !filter_var($_POST["search"], FILTER_SANITIZE_STRING) === false){
							$search = filter_var($_POST["search"], FILTER_SANITIZE_STRING);
							$query5 = $connect->prepare("SELECT sin_code, id, jkt_code, sup_code, chinese_name, cost, last_imported, last_updated, last_exported, name, quantity, scientific_name, sell, size, tank FROM fish_db WHERE sin_code = ? ORDER BY sin_code");
							$query5->bind_param("s", $search);
							$query5->bind_result($sin_code_result, $id_result, $jkt_code_result, $sup_code_result, $chinese_name_result, $cost_result, $last_imported_result, $last_updated_result, $last_exported_result, $name_result, $quantity_result, $scientific_name_result, $sell_result, $size_result, $tank_result);
							$query5->execute();
							while ($query5->fetch()){
								if ($quantity_result<=0) {
									echo "<li class='mdl-list__item mdl-list__item--three-line' onclick='fishProfile(\"".$id_result."\")'>
										<span class='mdl-list__item-primary-content'>
											<span>
												<strong>".$name_result."</strong>
												(".$chinese_name_result.")
											</span>
											<span class='mdl-list__item-text-body'>
												".$scientific_name_result."</br>
												<strong>SIN: </strong>".$sin_code_result." | <strong>JKT: </strong>".$jkt_code_result." | <strong>SUP: </strong>".$sup_code_result."
											</span>
										</span>
										<span class='mdl-list__item-secondary-content'>
											<span>
												</br>
												$".$sell_result." ($".$cost_result.")
											</span>
											<span class='mdl-list__item-text-body'>
												<strong>".$size_result."</strong> (<span style='color:red'>".$quantity_result."</span>) ".$tank_result."
											</span>
										</span>
									</li>";
								} else {
									echo "<li class='mdl-list__item mdl-list__item--three-line' onclick='fishProfile(\"".$id_result."\")'>
										<span class='mdl-list__item-primary-content'>
											<span>
												<strong>".$name_result."</strong>
												(".$chinese_name_result.")
											</span>
											<span class='mdl-list__item-text-body'>
												".$scientific_name_result."</br>
												<strong>SIN: </strong>".$sin_code_result." | <strong>JKT: </strong>".$jkt_code_result." | <strong>SUP: </strong>".$sup_code_result."
											</span>
										</span>
										<span class='mdl-list__item-secondary-content'>
											<span>
												</br>
												$".$sell_result." ($".$cost_result.")
											</span>
											<span class='mdl-list__item-text-body'>
												<strong>".$size_result."</strong> (".$quantity_result.") ".$tank_result."
											</span>
										</span>
									</li>";
								}
							}
						} else if (!empty($_POST["search"]) && is_string($_POST["search"]) && !filter_var($_POST["search"], FILTER_SANITIZE_STRING) === false){
							$search = filter_var($_POST["search"], FILTER_SANITIZE_STRING);
							$query4 = $connect->prepare("SELECT sin_code, id, jkt_code, sup_code, chinese_name, cost, last_imported, last_updated, last_exported, name, quantity, scientific_name, sell, size, tank FROM fish_db WHERE name LIKE ? ORDER BY sin_code");
							$wild = '%' . $search . '%';
							$query4->bind_param("s", $wild);
							$query4->bind_result($sin_code_result, $id_result, $jkt_code_result, $sup_code_result, $chinese_name_result, $cost_result, $last_imported_result, $last_updated_result, $last_exported_result, $name_result, $quantity_result, $scientific_name_result, $sell_result, $size_result, $tank_result);
							$query4->execute();
							while ($query4->fetch()){
								if ($quantity_result<=0) {
									echo "<li class='mdl-list__item mdl-list__item--three-line' onclick='fishProfile(\"".$id_result."\")'>
										<span class='mdl-list__item-primary-content'>
											<span>
												<strong>".$name_result."</strong>
												(".$chinese_name_result.")
											</span>
											<span class='mdl-list__item-text-body'>
												".$scientific_name_result."</br>
												<strong>SIN: </strong>".$sin_code_result." | <strong>JKT: </strong>".$jkt_code_result." | <strong>SUP: </strong>".$sup_code_result."
											</span>
										</span>
										<span class='mdl-list__item-secondary-content'>
											<span>
												</br>
												$".$sell_result." ($".$cost_result.")
											</span>
											<span class='mdl-list__item-text-body'>
												<strong>".$size_result."</strong> (<span style='color:red'>".$quantity_result."</span>) ".$tank_result."
											</span>
										</span>
									</li>";
								} else {
									echo "<li class='mdl-list__item mdl-list__item--three-line' onclick='fishProfile(\"".$id_result."\")'>
										<span class='mdl-list__item-primary-content'>
											<span>
												<strong>".$name_result."</strong>
												(".$chinese_name_result.")
											</span>
											<span class='mdl-list__item-text-body'>
												".$scientific_name_result."</br>
												<strong>SIN: </strong>".$sin_code_result." | <strong>JKT: </strong>".$jkt_code_result." | <strong>SUP: </strong>".$sup_code_result."
											</span>
										</span>
										<span class='mdl-list__item-secondary-content'>
											<span>
												</br>
												$".$sell_result." ($".$cost_result.")
											</span>
											<span class='mdl-list__item-text-body'>
												<strong>".$size_result."</strong> (".$quantity_result.") ".$tank_result."
											</span>
										</span>
									</li>";
								}
							}
						}
					?>
					</ul>
					<div class="mdl-cell mdl-cell--12-col" id="fishPicture">
						<span id="picture"><?php echo $name; ?></span>
					</div>
					<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect" id='fishDetailsTab'>
						<div class="mdl-tabs__tab-bar">
							<a href="#CCPPOPanel" class="mdl-tabs__tab is-active"><i class='material-icons'>list</i></a>
							<a href="#updatePanel" class="mdl-tabs__tab"><i class='material-icons'>file_upload</i></a>
							<a href="#inPanel" class="mdl-tabs__tab"><i class='material-icons'>flight_land</i></a>
							<a href="#outPanel" class="mdl-tabs__tab"><i class='material-icons'>flight_takeoff</i></a>
						</div>
						<div class="mdl-tabs__panel is-active" id="CCPPOPanel">
							<ul class="mdl-list">
								<li class="mdl-list__item">
									<span class="mdl-list__item-primary-content">
										<details class='mdl-expansion' id='fishProfileInInvoice'>
											<summary class='mdl-expansion__summary'>
												<span class='mdl-expansion__header'>
													In stock
												</span>
											</summary>
											<?php
												$query2 = $connect->prepare("SELECT date, ccp, quantity, supplier, user FROM in_stock WHERE fish_id=?");
												$query2->bind_param("i", $id);
												$query2->bind_result($date_result, $ccp_result, $quantity_result, $supplier_result, $user_result);
												$query2->execute();
												while ($query2->fetch()) {
													if ($email == "admin@admin.com"){
														echo "<li class='mdl-list__item'>
															<details class='mdl-expansion'>
																<summary class='mdl-expansion__summary'>
																	<span class='mdl-expansion__header'>".$date_result."</span>
																</summary>
																<div class='mdl-expansion__content mdl-list__item-primary-content'>
																	<li class='mdl-list__item'>
																		<span><strong>CCP: </strong>".$ccp_result."</span>
																	</li>
																	<li class='mdl-list__item'>
																		<span><strong>Quantity: </strong>".$quantity_result."</span>
																	</li>
																	<li class='mdl-list__item'>
																		<span><strong>Supplier: </strong>".$supplier_result."</span>
																	</li>
																	<li class='mdl-list__item'>
																		<span><strong>User: </strong><span style='color:red;'>".$user_result."</span></span>
																	</li>
																</div>
															</details>
														</li>";
													} else {
														echo "<li class='mdl-list__item'>
															<details class='mdl-expansion'>
																<summary class='mdl-expansion__summary'>
																	<span class='mdl-expansion__header'>".$date_result."</span>
																</summary>
																<div class='mdl-expansion__content mdl-list__item-primary-content'>
																	<li class='mdl-list__item'>
																		<span><strong>CCP: </strong>".$ccp_result."</span>
																	</li>
																	<li class='mdl-list__item'>
																		<span><strong>Quantity: </strong>".$quantity_result."</span>
																	</li>
																	<li class='mdl-list__item'>
																		<span><strong>Supplier: </strong>".$supplier_result."</span>
																	</li>
																</div>
															</details>
														</li>";
													}
												}
											?>
										</details>
									</span>
								</li>
								<li class="mdl-list__item">
									<span class="mdl-list__item-primary-content">
										<details class='mdl-expansion' id='fishProfileOutInvoice'>
											<summary class='mdl-expansion__summary'>
												<span class='mdl-expansion__header'>
													Out stock
												</span>
											</summary>
											<?php
												$query3 = $connect->prepare("SELECT date, quantity, po, user FROM out_stock WHERE fish_id=?");
												$query3->bind_param("i", $id);
												$query3->bind_result($date_result, $quantity_result, $po_result, $user_result);
												$query3->execute();
												while ($query3->fetch()) {
													if ($email == "admin@admin.com"){
														echo "<li class='mdl-list__item'>
															<details class='mdl-expansion'>
																<summary class='mdl-expansion__summary'>
																	<span class='mdl-expansion__header'>".$date_result."</span>
																</summary>
																<div class='mdl-expansion__content mdl-list__item-primary-content'>
																	<li class='mdl-list__item'>
																		<span><strong>Quantity: </strong>".$quantity_result."</span>
																	</li>
																	<li class='mdl-list__item'>
																		<span><strong>PO: </strong>".$po_result."</span>
																	</li>
																	<li class='mdl-list__item'>
																		<span><strong>User: </strong><span style='color:red;'>".$user_result."</span></span>
																	</li>
																</div>
															</details>
														</li>";
													} else {
														echo "<li class='mdl-list__item'>
															<details class='mdl-expansion'>
																<summary class='mdl-expansion__summary'>
																	<span class='mdl-expansion__header'>".$date_result."</span>
																</summary>
																<div class='mdl-expansion__content mdl-list__item-primary-content'>
																	<li class='mdl-list__item'>
																		<span><strong>Quantity: </strong>".$quantity_result."</span>
																	</li>
																	<li class='mdl-list__item'>
																		<span><strong>PO: </strong>".$po_result."</span>
																	</li>
																</div>
															</details>
														</li>";
													};
												}
											?>
										</details>
									</span>
								</li>
							</ul>
						</div>
						<div class="mdl-tabs__panel" id="updatePanel">
							<form action="<?php echo htmlspecialchars("../php/handle_updates.php?fish_id={$id}&email={$email}");?>" method="POST">
								<ul class="mdl-list">
									<li class="mdl-list__item mdl-list__item--two-line">
										<span class="mdl-list__item-primary-content">
											<i class="material-icons mdl-list__item-icon">keyboard_arrow_right</i>
											<span id="fishProfileLastUpdated"><?php echo $last_updated ?></span>
											<span class="mdl-list__item-sub-title"> last updated</span>
										</span>
									</li>
									<li class="mdl-list__item mdl-list__item--two-line">
										<span class="mdl-list__item-primary-content">
											<i class="material-icons mdl-list__item-icon">keyboard_arrow_right</i>
											<span id="fishProfileCost"><?php echo $cost ?></span>
											<span class="mdl-list__item-sub-title"> cost</span>
										</span>
										<span class="mdl-list__item-secondary-content">
											<span class="mdl-list__item-secondary-action">
												<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
													<label class="mdl-button mdl-js-button mdl-button--icon " for="fishProfileCostEdit">
														<i class="material-icons">mode_edit</i>
													</label>
													<div class="mdl-textfield__expandable-holder">
														<input class="mdl-textfield__input" type="text" id="fishProfileCostEdit" name="fish_cost">
														<label class="mdl-textfield__label" for="sample-expandable">Expandable Input</label>
													</div>
												</div>
											</span>
										</span>
									</li>
									<li class="mdl-list__item mdl-list__item--two-line">
										<span class="mdl-list__item-primary-content">
											<i class="material-icons mdl-list__item-icon">keyboard_arrow_right</i>
											<span id="fishProfileSell"><?php echo $sell ?></span>
											<span class="mdl-list__item-sub-title">sell</span>
										</span>
										<span class="mdl-list__item-secondary-content">
											<span class="mdl-list__item-secondary-action">
												<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
													<label class="mdl-button mdl-js-button mdl-button--icon " for="fishProfileSellEdit">
														<i class="material-icons">mode_edit</i>
													</label>
													<div class="mdl-textfield__expandable-holder">
														<input class="mdl-textfield__input" type="text" id="fishProfileSellEdit" name="fish_sell">
														<label class="mdl-textfield__label" for="sample-expandable">Expandable Input</label>
													</div>
												</div>
											</span>
										</span>
									</li>
									<li class="mdl-list__item mdl-list__item--two-line">
										<span class="mdl-list__item-primary-content fishProfileQuantity">
											<i class="material-icons mdl-list__item-icon">keyboard_arrow_right</i>
											<?php
												if ($quantity<=0){
													echo "<span style='color:red;'>".$quantity."</span>";
												} else {
													echo $quantity;
												}
											?>
											<span class="mdl-list__item-sub-title"> quantity</span>
										</span>
										<span class="mdl-list__item-secondary-content">
											<span class="mdl-list__item-secondary-action">
												<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
													<label class="mdl-button mdl-js-button mdl-button--icon " for="fishProfileQuantityEdit">
														<i class="material-icons">mode_edit</i>
													</label>
													<div class="mdl-textfield__expandable-holder">
														<input class="mdl-textfield__input" type="text" id="fishProfileQuantityEdit" name="fish_quantity">
														<label class="mdl-textfield__label" for="sample-expandable">Expandable Input</label>
													</div>
												</div>
											</span>
										</span>
									</li>
									<li class="mdl-list__item mdl-list__item--two-line">
										<span class="mdl-list__item-primary-content">
											<i class="material-icons mdl-list__item-icon">keyboard_arrow_right</i>
											<span id="fishProfileTank"><?php echo $tank ?></span>
											<span class="mdl-list__item-sub-title"> tank number</span>
										</span>
										<span class="mdl-list__item-secondary-content">
											<span class="mdl-list__item-secondary-action">
												<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
													<label class="mdl-button mdl-js-button mdl-button--icon " for="fishProfileTankEdit">
														<i class="material-icons">mode_edit</i>
													</label>
													<div class="mdl-textfield__expandable-holder">
														<input class="mdl-textfield__input" type="text" id="fishProfileTankEdit" name="tank_number" />
														<label class="mdl-textfield__label" for="sample-expandable">Expandable Input</label>
													</div>
												</div>
											</span>
										</span>
									</li>
								</ul>
								<div class="mdl-cell mdl-cell--12-col update">
									<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" id="updateFishProfileUpdate" name="submit">
										<span>Update</span>
									</button>
								</div>
							</form>
						</div>
						<div class="mdl-tabs__panel" id="inPanel">
							<form action=<?php echo htmlspecialchars("../php/handle_inStock.php?fish_id={$id}&email={$email}");?> method="POST">
								<ul class="mdl-list">
									<li class="mdl-list__item">
										<span class="mdl-list__item-primary-content">
											<i class="material-icons mdl-list__item-icon">keyboard_arrow_right</i>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="text" id="fishProfileInStockSup" name="supplier"/>
												<label class="mdl-textfield__label" for="fishProfileInStockSup">Enter supplier</label>
											</div>
										</span>
									</li>
									<li class="mdl-list__item">
										<span class="mdl-list__item-primary-content">
											<i class="material-icons mdl-list__item-icon">keyboard_arrow_right</i>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="fishProfileInStockQuantity" name="quantity"/>
												<label class="mdl-textfield__label" for="fishProfileInStockQuantity">Quantity</label>
												<span class="mdl-textfield__error">Input is not a number!</span>
											</div>
										</span>
									</li>
									<li class="mdl-list__item">
										<span class="mdl-list__item-primary-content">
											<i class="material-icons mdl-list__item-icon">keyboard_arrow_right</i>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="text" id="fishProfileInStockCCP" name="ccp"/>
												<label class="mdl-textfield__label" for="fishProfileInStockCCP">Enter CCP number</label>
											</div>
										</span>
									</li>
								</ul>
								<div class="mdl-cell mdl-cell--12-col update">
									<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" id="updateFishProfileInStock" name="submit">
										<span>Stock in</span>
									</button>
								</div>
							</form>
						</div>
						<div class="mdl-tabs__panel" id="outPanel">
							<form action=<?php echo htmlspecialchars("../php/handle_outStock.php?fish_id={$id}&email={$email}"); ?> method="POST">
								<ul class="mdl-list">
									<li class="mdl-list__item">
										<span class="mdl-list__item-primary-content">
											<i class="material-icons mdl-list__item-icon">keyboard_arrow_right</i>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="fishProfileOutStockQuantity" name="quantity"/>
												<label class="mdl-textfield__label" for="fishProfileOutStockQuantity">Quantity</label>
												<span id='overQuantity' class="mdl-textfield__error">Input is not a number!</span>
											</div>
										</span>
									</li>
									<li class="mdl-list__item">
										<span class="mdl-list__item-primary-content">
											<i class="material-icons mdl-list__item-icon">keyboard_arrow_right</i>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="fishProfileOutStockPO" name="po"/>
												<label class="mdl-textfield__label" for="fishProfileOutStockPO">Enter PO number</label>
												<span class="mdl-textfield__error">Input is not a number!</span>
											</div>
										</span>
									</li>
								</ul>
								<div class="mdl-cell mdl-cell--12-col update">
									<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" id="updateFishProfileOutStock" name="submit">
										<span>Stock out</span>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
      </main>
    </div>
    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
		<script src="https://www.gstatic.com/firebasejs/3.9.0/firebase.js"></script>
		<script src="../js/config.js"></script>
		<script src="../js/checkAuth.js" defer></script>
		<script src="../js/filter.js"></script>
  </body>
</html>

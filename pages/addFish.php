<?php
	header('Content-Type: text/html; charset=utf-8');
	require "db_config.php";
	mysqli_set_charset($connect,"utf8");
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
          <span class="mdl-layout-title">Add Fish</span>
          <div class="mdl-layout-spacer"></div>
					<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="POST">
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
					<a class="mdl-navigation__link" href="addFish.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">add</i>Add Fish</a>
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
							$query5 = $connect->prepare("SELECT sin_code, id, jkt_code, sup_code, chinese_name, cost, last_imported, last_updated, last_exported, name, quantity, scientific_name, sell, size, tank FROM fish_db WHERE sin_code = ?");
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
							$query4 = $connect->prepare("SELECT sin_code, id, jkt_code, sup_code, chinese_name, cost, last_imported, last_updated, last_exported, name, quantity, scientific_name, sell, size, tank FROM fish_db WHERE name LIKE ? ");
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
					<form action=<?php echo htmlspecialchars("../php/handle_addFish.php");?> method="POST" id="addFishForm">
						<ul class="mdl-list">
							<li class="mdl-list__item">
								<span class="mdl-list__item-primary-content">
									<i class="material-icons mdl-list__item-icon">keyboard_arrow_right</i>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text" id="addFishSinCode" name="sin_code"/>
										<label class="mdl-textfield__label" for="addFishSinCode">Enter SIN Code</label>
									</div>
								</span>
							</li>
							<li class="mdl-list__item">
								<span class="mdl-list__item-primary-content">
									<i class="material-icons mdl-list__item-icon">keyboard_arrow_right</i>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text" id="addFishJktCode" name="jkt_code"/>
										<label class="mdl-textfield__label" for="addFishJktCode">Enter JKT Code</label>
									</div>
								</span>
							</li>
							<li class="mdl-list__item">
								<span class="mdl-list__item-primary-content">
									<i class="material-icons mdl-list__item-icon">keyboard_arrow_right</i>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text" id="addFishSupCode" name="sup_code"/>
										<label class="mdl-textfield__label" for="addFishSupCode">Enter SUP Code</label>
									</div>
								</span>
							</li>
							<li class="mdl-list__item">
								<span class="mdl-list__item-primary-content">
									<i class="material-icons mdl-list__item-icon">keyboard_arrow_right</i>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text" id="addFishName" name="name"/>
										<label class="mdl-textfield__label" for="addFishName">Enter Name</label>
									</div>
								</span>
							</li>
							<li class="mdl-list__item">
								<span class="mdl-list__item-primary-content">
									<i class="material-icons mdl-list__item-icon">keyboard_arrow_right</i>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text" id="addFishScientificName" name="scientific_name"/>
										<label class="mdl-textfield__label" for="addFishScientificName">Enter Scientific Name</label>
									</div>
								</span>
							</li>
							<li class="mdl-list__item">
								<span class="mdl-list__item-primary-content">
									<i class="material-icons mdl-list__item-icon">keyboard_arrow_right</i>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text" id="addFishChineseName" name="chinese_name"/>
										<label class="mdl-textfield__label" for="addFishChineseName">Enter Chinese Name</label>
									</div>
								</span>
							</li>
							<li class="mdl-list__item">
								<span class="mdl-list__item-primary-content">
									<i class="material-icons mdl-list__item-icon">keyboard_arrow_right</i>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="addFishCost" name="cost"/>
										<label class="mdl-textfield__label" for="addFishCost">Cost Price</label>
										<span class="mdl-textfield__error">Input is not a number!</span>
									</div>
								</span>
							</li>
							<li class="mdl-list__item">
								<span class="mdl-list__item-primary-content">
									<i class="material-icons mdl-list__item-icon">keyboard_arrow_right</i>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="addFishSell" name="sell"/>
										<label class="mdl-textfield__label" for="addFishSell">Sell Price</label>
										<span class="mdl-textfield__error">Input is not a number!</span>
									</div>
								</span>
							</li>
							<li class="mdl-list__item">
								<span class="mdl-list__item-primary-content">
									<i class="material-icons mdl-list__item-icon">keyboard_arrow_right</i>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="addFishQuantity" name="quantity"/>
										<label class="mdl-textfield__label" for="addFishQuantity">Quantity</label>
										<span class="mdl-textfield__error">Input is not a number!</span>
									</div>
								</span>
							</li>
							<li class="mdl-list__item">
								<span class="mdl-list__item-primary-content">
									<i class="material-icons mdl-list__item-icon">keyboard_arrow_right</i>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text" id="addFishSize" name="size"/>
										<label class="mdl-textfield__label" for="addFishSize">Enter Size</label>
									</div>
								</span>
							</li>
							<li class="mdl-list__item">
								<span class="mdl-list__item-primary-content">
									<i class="material-icons mdl-list__item-icon">keyboard_arrow_right</i>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text" id="addFishTank" name="tank"/>
										<label class="mdl-textfield__label" for="addFishTank">Enter Tank</label>
									</div>
								</span>
							</li>
						</ul>
						<div class="mdl-cell mdl-cell--12-col update">
							<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" id="addFishBtn" name="submit">
								<span>Add fish</span>
							</button>
						</div>
					</form>
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
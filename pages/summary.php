<?php
	header('Content-Type: text/html; charset=utf-8');
	require "db_config.php";
	mysqli_set_charset($connect,"utf8");  
	$query = $connect->prepare("SELECT sin_code, id, jkt_code, sup_code, chinese_name, cost, name, quantity, scientific_name, sell, size, tank FROM fish_db ORDER BY sin_code");  
	$query->bind_result($sin_code, $id, $jkt_code, $sup_code, $chinese_name, $cost, $name, $quantity, $scientific_name, $sell, $size, $tank);
	mysqli_set_charset($connect,"utf8");
	$query->execute();
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
		<div class="loginCover">
			<div class="mdl-spinner mdl-js-spinner is-active">
			</div>
		</div>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title">Summary</span>
          <div class="mdl-layout-spacer"></div>
					<form>
						<div class="mdl-textfield mdl-js-textfield">
							<input class="mdl-textfield__input" type="text" id="search" name="search" onkeyup="filter()">
							<label class="mdl-textfield__label" for="search">Search...</label>
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
        <div class="mdl-grid">
					<ul class="mdl-list" id="fishList">
						<?php
							while ($query->fetch()) {
								if ($quantity<=0) {
									echo "<li class='mdl-list__item mdl-list__item--three-line' onclick='fishProfile(\"".$id."\")'>
										<span class='mdl-list__item-primary-content'>
											<span>
												<strong>".$name."</strong>
												(".$chinese_name.")
											</span>
											<span class='mdl-list__item-text-body'>
												".$scientific_name."</br>
												<strong>SIN: </strong>".$sin_code." | <strong>JKT: </strong>".$jkt_code." | <strong>SUP: </strong>".$sup_code."
											</span>
										</span>
										<span class='mdl-list__item-secondary-content'>
											<span>
												</br>
												$".$sell." ($".$cost.")
											</span>
											<span class='mdl-list__item-text-body'>
												<strong>".$size."</strong> (<span style='color:red'>".$quantity."</span>) ".$tank."
											</span>
										</span>
									</li>";
								} else {
									echo "<li class='mdl-list__item mdl-list__item--three-line' onclick='fishProfile(\"".$id."\")'>
										<span class='mdl-list__item-primary-content'>
											<span>
												<strong>".$name."</strong>
												(".$chinese_name.")
											</span>
											<span class='mdl-list__item-text-body'>
												".$scientific_name."</br>
												<strong>SIN: </strong>".$sin_code." | <strong>JKT: </strong>".$jkt_code." | <strong>SUP: </strong>".$sup_code."
											</span>
										</span>
										<span class='mdl-list__item-secondary-content'>
											<span>
												</br>
												$".$sell." ($".$cost.")
											</span>
											<span class='mdl-list__item-text-body'>
												<strong>".$size."</strong> (<span>".$quantity."</span>) ".$tank."
											</span>
										</span>
									</li>";
								}
							}
							mysqli_close($connect);
						?>
					</ul>
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
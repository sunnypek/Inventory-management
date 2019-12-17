$("#loginBtn").click(
	function(){
		$(".loginCover").css('display','flex');
		var username = $("#username").val();
		var password = $("#password").val();

		firebase.auth().signInWithEmailAndPassword(username, password).catch(function(error) {
			// Handle Errors here.
			var errorCode = error.code;
			var errorMessage = error.message;
			$(".loginCover").hide();
		});
	}
);
firebase.auth().onAuthStateChanged(function(user) {
	if (user) {
		var email = user.email;
		window.location = 'pages/home.php';
	} else {
		// No user is signed in.
	}
});

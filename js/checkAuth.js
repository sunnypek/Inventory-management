$(".loginCover").css("display","flex");
firebase.auth().onAuthStateChanged(function(user) {
	if (user) {
		var email = user.email;
		$(".signedInEmail").text(email);
	} else {
		window.location = '../index.php';
	}
});
$("#logout").click(
	function(){
		firebase.auth().signOut().then(function() {
			window.location = "../index.php";
		}).catch(function(error) {
			// An error happened.
		});
	}
)
$(".loginCover").hide();
function isEmpty(el){
	return !$.trim(el.html())
}
if (isEmpty($("#fishSearch"))) {
	$("#fishSearch").css("display", "none");
} else {
	$("#fishSearch").css("display", "initial");
}
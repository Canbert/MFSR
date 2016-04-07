//this script will give a message if the data is succesfully sent, which will fade out after 6 seconds 
$('form').submit(function() {
	var oldpass = $("#oldPass").val();
	var newpass = $("#newPass").val();
	var renewpass = $("#reNewPass").val();
	$.ajax({
		url : 'php/change-password.php',
		type: "POST",
		data : {
			oldPass: oldpass,
			newPass: newpass,
			reNewPass: renewpass
		    	},
		success: function(data) {
			if (data){
				$('#feedback').html(data);
				if(data == "Password changed"){
					$('#feedback').siblings().hide();
				}
					//$('#feedback').fadeIn('slow', function() {
					//	$('#feedback').fadeOut(6000);
					//});
			}	
		}
	});
	return false
});

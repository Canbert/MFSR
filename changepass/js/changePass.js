//this script will give a message if the data is succesfully sent, which will fade out after 6 seconds 
$('form').submit(function() {
	var oldpass = $("#oldPass").val();
	var newpass = $("#newPass").val();
	var renewpass = $("#reNewPass").val();
	$.ajax({
		url : 'php/changepass.php',
		type: "POST",
		data : {
			oldPass: oldpass,
			newPass: newpass,
			reNewPass: renewpass
		    	},
		success: function(data) {
			if (data){
				$('#feedback').html(data);
					$('#feedback').fadeIn('slow', function() {
						$('#feedback').fadeOut(6000);
					});	
			}	
		}
	});
	return false
});

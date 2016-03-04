//this script will give a message if the data is succesfully sent, which will fade out after 6 seconds 
$('form').submit(function() {
	var user = $("#username").val();
	var pass = $("#password").val();
	$.ajax({
		url : 'php/login.php',
		type: "POST",
		data : {
			username: user,
			password: pass
		    	},
		success: function(data) {
			
			if (data){
				$('#feedback').html(data);
					$('#feedback').fadeIn('fast', function() {
						$('#feedback').fadeOut(6000);
					});	
			}	
		}
	});
	return false
});

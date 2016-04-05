butt = $("#toggleSideBar");
butt.text('<<');
$(butt).click(function() {
	$("#sideBar").toggle("fast", function() {
        if ($('#sideBar').is(':visible')) {
            butt.text('<<');
            $("#sideBarWrapper").css('width','300px'); 
            $("#toggleSideBar").css('width','10%');          
        } else {
            butt.text('>>');
            $("#sideBarWrapper").css('width','30px'); 
            $("#toggleSideBar").css('width','100%');          
        }  
	});
});
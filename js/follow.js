$("a.followBtn").on("click", function (e) {
	var follow_id = ($(this).data('id'));

    $.ajax({
		method: "POST",
		url: "ajax/follow.php",
		data: { follow_id: follow_id },
		dataType: "json"
	}).done(function (res) {
		console.log(res);
    });
    
	e.preventDefault();
}); 
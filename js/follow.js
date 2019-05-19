$("a.followBtn").on("click", function (e) {
	var user_id = ($(this).data('id'));

    $.ajax({
		method: "POST",
		url: "ajax/follow.php",
		data: { user_id: user_id },
		dataType: "json"
	}).done(function (res) {
		console.log(res);
    });
    
	e.preventDefault();
}); 
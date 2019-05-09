
	$("a.likes").on("click", function(e){
		var postsId = $(this).data('id');
		console.log(postsId);

		$.ajax({
			method: "POST",
			url: "ajax/like.php",
			data: { postsId: postsId },
			dataType: "json"
		})

		.done(function( res ) {
			console.log("test 123")

			if(res.status == "success"){
			likes++;
			elLikes.html(likes);
			}
			// console.log(res);
		});

		e.preventDefault();
	});
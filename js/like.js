$(document).ready(function(){
	$("a.likes").on("click", function(e){
		var postId = $(this).data('id');

		$.ajax({
			method: "POST",
			url: "../ajax/like.php",
			data: { postId: postId },
			dataType: "json"
		})

		.done(function( res ) {
			if(res.status == "success"){
			likes++;
			elLikes.html(likes);
			}
			// console.log(res);
		});

		e.preventDefault();
	});
});
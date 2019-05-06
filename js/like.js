$(document).ready(() => {
		$("a.like").on("click", function(e){
			// op welke post?
			var postId = $(this).data('id');
			var elLikes = $(this).parent().find(".likes");
			var likes = elLikes.html();

			$.ajax({
				method: "POST",
				url: "ajax/like.php",
				data: { postId: postId },
				dataType: "json"
			})
			.done(function( res ) {
				if(res.status == "success"){
					likes++;
					elLikes.html(likes);
				}
			});
			e.preventDefault();
		});
});
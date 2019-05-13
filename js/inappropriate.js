// $("a.likes").on("click", function (e) {
// 	var postsId = $(this).data('id');
// 	var elLikes = $(this).parent().find(".likesAmount");
// 	var likes = elLikes.text();

// 	$.ajax({
// 		method: "POST",
// 		url: "ajax/like.php",
// 		data: { postsId: postsId },
// 		dataType: "json"
// 	}).done(function (res) {
// 		// console.log("test 123");
// 		console.log(res);
// 		if (res.status == "success") {
// 			likes++;
// 			elLikes.text(likes);
// 		} else if (res.status == "fail") {
// 			likes--;
// 			elLikes.text(likes);
// 		}
// 		// console.log(res);
// 	});

// 	e.preventDefault();
// }); 

$("a.report").on("click",function (e){
    var postsId = $(this).data('id');

    e.preventDefault();
});
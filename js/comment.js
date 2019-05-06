$("#btnSubmit").on("click", function(e){

    var postsId = $(this).data("id");

	var text = $("#comment").val();
	//console.log(text + postsId);

	$.ajax({
  		method: "POST",
  		url: "ajax/postcomment.php",
  		data: {text: text, postsId: postsId}, 
		dataType: "json"
	})
  	.done(function( res ) {

	    if(res.status == "Success"){
			var li = "<li style='display: none';>" + text + "</li>";
			$("#listupdates").append(li);
			$("#comment").val("").focus();
			$("#listupdates li").last().slideDown();

		} else{
            alert("Comment failed.");
        }

  	});
		
	e.preventDefault();
	});

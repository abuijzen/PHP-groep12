$("#btnSubmit").on("click", function(e){

	var text = $("#comment").val();
	//console.log(text);

	$.ajax({
  		method: "POST",
  		url: "ajax/postcomment.php",
  		data: {text: text}, 
		dataType: "json"
	})
  	.done(function( res ) {
		//console.log(res.status);

	    if(res.status == "Success"){
			var li = "<li style='display: none';>" + text + "</li>";
			$("#listupdates").append(li);
			$("#comment").val("").focus();
			$("#listupdates li").last().slideDown();

		}

  	});
		
	e.preventDefault();
	});

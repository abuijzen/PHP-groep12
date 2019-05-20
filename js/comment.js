$("#btnSubmit").on("click", function(e){

    var postsId = $(this).data("id");

	var text = $("#comment").val();

	var sanitizeHTML = function (text) {
		var temp = document.createElement('div');
		temp.textContent = text;
		return temp.innerHTML;
	};

	var safeText = sanitizeHTML(text);
	//console.log(text + postsId);

	$.ajax({
  		method: "POST",
  		url: "ajax/postcomment.php",
  		data: {text: text, postsId: postsId}, 
		dataType: "json"
	})
  	.done(function( res ) {
	    if(res.status == "Success"){
			var li = "<li style='display: none';>" + safeText + "</li>";
			$("#listupdates").append(li);
			$("#comment").val("").focus();
			$("#listupdates li").last().slideDown();

		} else{
            alert("Comment failed.");
        }

  	});
		
	e.preventDefault();
	});

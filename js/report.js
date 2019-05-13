$("a.report").on("click",function (e){
    var post_Id = $(this).data('id');
    console.log(post_Id);
    
    $.ajax({
		method: "POST",
		url: "ajax/report.php",
		data: { post_Id: post_Id },
        dataType: "json"
    })
    .done(function(res){
        console.log(res);
		if (res.status == "success") {
			swal(res.message);
		} else if (res.status == "fail") {
            swal(res.message);
		}
    });

    e.preventDefault();
});
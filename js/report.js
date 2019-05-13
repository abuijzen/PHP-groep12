$("a.report").on("click",function (e){
    var postsId = $(this).data('id');
    console.log(postsId);
    
    $.ajax({
		method: "POST",
		url: "ajax/report.php",
		data: { postsId: postsId },
        dataType: "json"
    })
    .done(function(res){
        console.log(res);
		if (res.status == "success") {
			swal("Report has been added",res.message);
		} else if (res.status == "fail") {
            swal(res.message);
		}
    });

    e.preventDefault();
});
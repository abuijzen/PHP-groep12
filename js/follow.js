$("a.followBtn").on("click", function (e) {
        var follow_id = ($(this).data('id'));
        var button = $(this);

        $.ajax({
            method: "POST",
            url: "ajax/follow.php",
            data: { follow_id: follow_id },
            dataType: "json"
        }).done(function (res) {
            if (res.status == "success") {
                button.text("Following");
            } else if (res.status == "fail") {
                button.text("Follow");
            }
            
        });
        
        e.preventDefault();
    }); 
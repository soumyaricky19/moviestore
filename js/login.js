$(document).ready(function() {
    $('#submit').click(function(e){
        var parent_url=window.location.href;
        $.ajax({
            url: 'login.php',
            type: 'POST',
            data: {userid: $("#userid").val() ,password: $("#password").val()},
            success:function(data){
                alert(data);
                window.location.href = "home.php";								
            },
            error:function(err){
                alert(err);
            }
        });
    });
});

    
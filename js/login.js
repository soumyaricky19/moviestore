$(document).ready(function() {
    $('#submit').click(function(e){
        var parent_url=window.location.href;
        $.ajax({
            url: 'login.php',
            type: 'POST',
            data: {userid: $("#userid").val() ,password: $("#password").val()},
            success:function(data){
                if (data.indexOf("ok")>-1)
                {
                    alert("Login successful");
                }
                else
                {
                    alert("Incorrect username/password");
                }
                window.location.href = "home.php";								
            },
            error:function(err){
                alert(err);
            }
        });
    });
});

    
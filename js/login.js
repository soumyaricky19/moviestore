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
                    window.location.href = "home.php";	
                }
                else
                {
                    alert("Incorrect username/password");
                }							
            },
            error:function(err){
                alert(err);
            }
        });
    });
});

    
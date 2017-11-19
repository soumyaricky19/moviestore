$(document).ready(function() {
    $('#loginForm').submit(function(e){
        $.ajax({
            url: 'login.php',
            type: 'POST',
            data: {userid: $("#userid").val() ,password: $("#password").val()},
            success:function(data){
                if (data.indexOf("Login successful") > -1) {
                    alert("Login successful");
                    window.location.href = "home.php";	
                }
                else {
                    alert(data);
                }							
            },
            error:function(err){
                alert(err);
            }
        });
    });

    $('li#login a').mouseover(function(){  
        $(this).trigger('click');  
    });
});

    
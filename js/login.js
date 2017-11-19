$(document).ready(function() {
    $('#loginForm').submit(function(e){
        var current_page=window.location.href;
        $.ajax({
            url: 'login.php',
            type: 'POST',
            data: {userid: $("#userid").val() ,password: $("#password").val()},
            success:function(data){
                if (data.indexOf("Login successful") > -1) {
                    alert("Login successful");
                    window.location.href = current_page;	
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

    
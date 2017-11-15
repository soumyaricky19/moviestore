$(document).ready(function() {
    
    $('#submit').click(function(e){
        $.ajax({
            url: 'login.php',
            type: 'POST',
            data: {userid: $("#userid").val() ,password: $("#password").val()},
            success:function(data){
                if (data == "Login successful") {
                    alert(data);
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
});

    
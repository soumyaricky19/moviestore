$(document).ready(function() {
    $('#loginForm').submit(function(e){
        var current_page=window.location.href;
        $.ajax({
            url: 'login.php',
            type: 'POST',
            data: {userid: $("#userId").val() ,password: $("#pass").val()},
            success:function(data){
                if (data.indexOf("Login successful") > -1) {
                    alert("Login successful");
                    var myRe = new RegExp('{.*}', 'g');
                    var myArray = myRe.match(data);
                    for (msg in myArray) {
                        var res = msg.split(":");
                        alert(res);
                    }
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

    
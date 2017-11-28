$(document).ready(function() {
    $('#loginForm').submit(function(e){
        var current_page=window.location.href;
        $.ajax({
            url: 'login.php',
            type: 'POST',
            data: {userid: $("#userId").val() ,password: $("#pass").val()},
            success:function(data){
                var data_comma = data.replace(/}{/g,"},{");
                var data_list="["+data_comma+"]";
                var messages = JSON.parse(data_list);
                var msg="";
                for (i = 0; i < messages.length; i++) {
                    msg=messages[i].message;
                    alert(msg);
                }
                if (msg.indexOf("Login successful")>-1) {
                    window.location.href=current_page;
                }
            },
            error:function(err){
                alert(err);
            }
        });
    });

    // $('li#login a').mouseover(function(){  
    //     $(this).trigger('click');  
    // });
});

    
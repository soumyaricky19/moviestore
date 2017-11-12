$(document).ready(function() {
    var nameReg=new RegExp(/^[A-Za-z ]+$/);
    var numberReg=new RegExp(/^[0-9]+$/);
    var uNameReg=new RegExp(/^[A-Za-z0-9]+$/);
    var emailReg=new RegExp(/^[A-Za-z0-9]+\@[a-z0-9A-Z\.]+$/);
    $("#userid").after("<span id=uNameNote class=\"info\">The userid field must contain only alphabetical or numeric characters</span>");
    $("#password").after("<span id=pwdNote class=\"info\">The password field should be at least 8 characters long</span>");
    // $("#email").after("<span id=emailNote class=\"info\">The email field should be a valid email address (local-part@domain)</span>");
    $("#userid").after("<span id=uNameError class=\"error\">Error</span>");
    $("#userid").after("<span id=uNameSuccess class=\"ok\">OK</span>");
    $("#password").after("<span id=pwdError class=\"error\">Error</span>");
    $("#password").after("<span id=pwdSuccess class=\"ok\">OK</span>");
    $("#name").after("<span id=nameNote class=\"info\">The name field must contain only alphabetical characters</span>");
    $("#name").after("<span id=nameError class=\"error\">Error</span>");
    $("#name").after("<span id=nameSuccess class=\"ok\">OK</span>");

    $("#name").after("<span id=name_status></span>");

    $("#card_info").after("<span id=cardNote class=\"info\">The card information field must contain 16 digit number</span>");
    $("#card_info").after("<span id=cardError class=\"error\">Error</span>");
    $("#card_info").after("<span id=cardSuccess class=\"ok\">OK</span>");
    $("#phonenumber").after("<span id=phoneNote class=\"info\">The card information field must contain 10 digit number</span>");
    $("#phonenumber").after("<span id=phoneError class=\"error\">Error</span>");
    $("#phonenumber").after("<span id=phoneSuccess class=\"ok\">OK</span>");
    $("#phonenumber").after("<span id=results></span>");
    // $("#email").after("<span id=emailError class=\"error\">Error</span>");
    // $("#email").after("<span id=emailSuccess class=\"ok\">OK</span>");


    $("#uNameSuccess,#uNameError,#uNameNote,#pwdNote,#emailNote,#pwdError,#pwdSuccess,#emailError,#emailSuccess,#phoneNote,#phoneError,#phoneSuccess,#nameNote,#nameError,#nameSuccess,#cardNote,#cardError,#cardSuccess").hide();  
    $("#userid").focus(function(){
        $("#uNameSuccess,#uNameError").hide();  
        $("#uNameNote").show();
    });
    $("#password").focus(function(){
        $("#pwdError,#pwdSuccess").hide();  
        $("#pwdNote").show();
    });
    $("#name").focus(function(){
        $("#nameError,#nameSuccess").hide();  
        $("#nameNote").show();
    });
    $("#card_info").focus(function(){
        $("#cardError,#cardSuccess").hide();  
        $("#cardNote").show();
    });
    $("#phonenumber").focus(function(){
        $("#phoneError,#phoneSuccess").hide();  
        $("#phoneNote").show();
    });
    // $("#email").focus(function(){
    //     $("#emailError,#emailSuccess").hide(); 
    //     $("#emailNote").show();
    // });


    $("#userid").focusout(function(){
        $("#uNameNote").hide();  
        var userid=$("#userid").val();
        if(userid.length!=0){
            if(!uNameReg.test(userid)){
                $("#uNameError").show();
            }
            else{
                $.ajax({
                    url: "signup.php",
                    type: "POST",
                    data: {
                        "userid": userid
                    },
                    
                    success: function(result) {
                        alert(result);
                        if(result=="Ok")	
                            {
                                $("#uNameError").hide();
                                $("#uNameSuccess").show();	
                            }
                            else
                            {
                                $("#uNameSuccess").hide();
                                $("#uNameError").show();
                            }
                    }
                });
            }
        }
    });
    $("#password").focusout(function(){
        $("#pwdNote").hide();    
        var password=$("#password").val();
        if(password.length!=0){
            if(password.length<8){
                $("#pwdError").show();
            }
            else{
                $("#pwdSuccess").show();
        }
    }
    });
    $("#name").focusout(function(){
        var name1=$("#name").val();
        $("#nameNote").hide();    
        
        if(name1.length!=0){
            if(!nameReg.test(name1)){
                $("#nameError").show();
            }
            else{
                $("#nameSuccess").show();
            }
    }
    });
    $("#card_info").focusout(function(){
        $("#cardNote").hide();    
        var card_info=$("#card_info").val();
        if(card_info.length!=0){
            if(!numberReg.test(card_info) || card_info.length!=16){
                $("#cardError").show();
            }
            else{
                $("#cardSuccess").show();
            }
    }
    });
    $("#phonenumber").focusout(function(){
        $("#phoneNote").hide();    
        var phonenumber=$("#phonenumber").val();
        if(phonenumber.length!=0){
            if(!numberReg.test(phonenumber) || phonenumber.length!=10){
                $("#phoneError").show();
            }
            else{
                $.ajax({
                    url: "signup.php",
                    type: "POST",
                    data: {
                        "phonenumber": phonenumber
                    },
                    success: function(result) {
                        alert(result);
                        if(result=="Ok")
                            {
                                $("#phoneError").hide();
                                $("#phoneSuccess").show();	
                            }
                            else
                            {
                                $("#phoneSuccess").hide();
                                $("#phoneError").show();
                            }
                    }
                });
            }
    }
});
    
$("#submit").click(function() {
        var userid=$("#userid").val();
        var name1=$("#name").val();
        var address=$("#address").val();
        var password=$("#password").val();
        var card_info=$("#card_info").val();
        var phonenumber=$("#phonenumber").val();
        $.ajax({
            url: "signup2.php",
            type: "POST",
            data: {
                "userid": userid,
                "address": address,
                "name": name1,
                "password": password,
                "card_info": card_info,
                "phonenumber": phonenumber
            },
            success: function(data){
                alert(data);
                window.location.href = "home.php";
            }
        }); 
    
    });
    
    // $("#email").focusout(function(){
    //     $("#emailNote").hide();    
    //     var Email=$("#email").val();
    //     if(Email.length!=0){
    //         if(!emailReg.test(Email)){
    //             $("#emailError").show();
    //         }
    //         else{
    //             $("#emailSuccess").show();
    //     }
    // }  
    // });
});

    
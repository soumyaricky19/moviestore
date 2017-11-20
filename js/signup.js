$(document).ready(function() {
    
    var nameReg = new RegExp(/^[A-Za-z ]+$/);
    var numberReg = new RegExp(/^[0-9]+$/);
    var uNameReg = new RegExp(/^[A-Za-z0-9]+$/);
    var emailReg = new RegExp(/^[A-Za-z0-9]+\@[a-z0-9A-Z\.]+$/);
    var passwordReg = new RegExp(/((?=.*\d)(?=.*[A-Z])(?=.*\W).{8,})/);
    var useridFlag = false;
    var userNameFlag = false;
    var passwordFlag = false;
    var addressFlag = true;
    var cardFlag = false;
    var phoneFlag = false;
    var confirmPasswordFlag = false;
    
    $("#userid").after("<span id='uNameNote' class='info'>The userid field must contain only alphabetical or numeric characters</span>");
    $("#password-strength-text").after("<span id='pwdNote' class=\"info\">Password must be 8 characters including 1 uppercase letter, 1 special character, alphanumeric characters</span>");
    $("#name").after("<span id='nameNote' class=\"info\">The name field must contain only alphabetical characters</span>");
    $("#card_info").after("<span id='cardNote' class=\"info\">The card information field must contain 16 digit number</span>");
    $("#phonenumber").after("<span id='phoneNote' class=\"info\">The phone number must contain 10 digits</span>");
    $("#cnfPassword").after("<span id='confirmPassNote' class=\"info\">Password does not match</span>");
    

    $("#uNameNote,#pwdNote,#emailNote,#phoneNote,#nameNote,#cardNote,#confirmPassNote").hide();  
    
    $("#userid").focus(function(){
        $("#uNameNote").text("The userid field must contain only alphabetical or numeric characters");
        $("#uNameNote").show();
    });

    $("#password").focus(function(){
        $("#pwdNote").show();
    });
    
    $("#cnfPassword").focus(function(){
        $("#confirmPassNote").hide();
    });
    
    $("#name").focus(function(){
        $("#nameNote").show();
    });
    
    $("#card_info").focus(function(){
        $("#cardNote").show();
    });
    
    $("#phonenumber").focus(function(){
        $("#phoneNote").text("The phone number must contain 10 digits");
        $("#phoneNote").show();
    });
    
    $("#userid").focusout(function(){
        $("#uNameNote").hide();  
        var userid = $("#userid").val();
        if(userid.length != 0){
            if(!uNameReg.test(userid)){
                $("#userid").removeClass('ok').addClass('error');
            }
            else{
                $.ajax({
                    url: "signup.php",
                    type: "POST",
                    data: {"userid": userid},
                    success: function(result) {
                        if(result == "Ok"){
                            $("#userid").removeClass('error').addClass('ok'); 
                            useridFlag = true;
                        }
                        else{
                            $("#userid").removeClass('ok').addClass('error');
                            $("#uNameNote").text(result).show();  
                            useridFlag = false;
                        }
                    }
                });
            }
        }
        else{
            $("#userid").removeClass('error').removeClass('ok');
        }
    });

    $("#password").focusout(function(){
        $("#pwdNote").hide();    
        var password = $("#password").val();
        if(password.length != 0){
            if(!passwordReg.test(password)){
                $("#password").removeClass('ok').addClass('error');  
                passwordFlag = false;     
            }
            else{
                $("#password").removeClass('error').addClass('ok');    
                passwordFlag = true;  
            }
        }
        else{
            $("#password").removeClass('error').removeClass('ok');
        }
    });

    $("#cnfPassword").focusout(function(){    
        var password = $("#password").val();
        var confirmPass = $("#cnfPassword").val();
        
        if(confirmPass.length != 0){
            if(password != confirmPass){
                $("#cnfPassword").removeClass('ok').addClass('error');  
                $("#confirmPassNote").show();
                confirmPasswordFlag = false;     
            }
            else{
                $("#confirmPassNote").hide();
                $("#cnfPassword").removeClass('error').addClass('ok');    
                confirmPasswordFlag = true;  
            }
        }
        else{
            $("#cnfPassword").removeClass('error').removeClass('ok');
        }
    });

    $("#name").focusout(function(){
        var name1=$("#name").val();
        $("#nameNote").hide();    
        if(name1.length != 0){
            if(!nameReg.test(name1)){
                $("#name").removeClass('ok').addClass('error');
                userNameFlag = false;
            }
            else{
                $("#name").removeClass('error').addClass('ok');
                userNameFlag = true;
            }
        }
        else{
            $("#name").removeClass('error').removeClass('ok');
        }
    });
    $("#card_info").focusout(function(){
        $("#cardNote").hide();    
        var card_info = $("#card_info").val();
        if(card_info.length != 0){
            if(!numberReg.test(card_info) || card_info.length!=16){
                $("#card_info").removeClass('ok').addClass('error');    
                cardFlag = false;         
            }
            else{
                $("#card_info").removeClass('error').addClass('ok');      
                cardFlag = true; 
            }
        }
        else{
            $("#card_info").removeClass('error').removeClass('ok');
        }
    });
    $("#phonenumber").focusout(function(){
        $("#phoneNote").hide();    
        var phonenumber = $("#phonenumber").val();
        if(phonenumber.length != 0){
            if(!numberReg.test(phonenumber) || phonenumber.length != 10){
                $("#phonenumber").removeClass('ok').addClass('error');       
            }
            else{
                $.ajax({
                    url: "signup.php",
                    type: "POST",
                    data: {"phonenumber": phonenumber },
                    success: function(result) {
                        if(result=="Ok"){
                            $("#phonenumber").removeClass('error').addClass('ok');
                            phoneFlag = true;
                        }
                        else{
                            $("#phonenumber").removeClass('ok').addClass('error');
                            $("#phoneNote").text(result).show();  
                            phoneFlag = false;
                        }
                    }
                });
            }
        }
        else{
            $("#phonenumber").removeClass('error').removeClass('ok');
        }
    });


    function validateUserID(){
        $("#uNameNote").hide();  
        var userid = $("#userid").val();
        if(userid.length != 0){
            if(!uNameReg.test(userid)){
                $("#userid").removeClass('ok').addClass('error');
            }
            else{
                $.ajax({
                    url: "signup.php",
                    type: "POST",
                    async: false,
                    data: {"userid": userid},
                    success: function(result) {
                        if(result == "Ok"){
                            $("#userid").removeClass('error').addClass('ok'); 
                            useridFlag = true;
                        }
                        else{
                            $("#userid").removeClass('ok').addClass('error');
                            $("#uNameNote").text(result).show();  
                            useridFlag = false;
                        }
                    }
                });
            }
        }
        return useridFlag;
    }

    function validatePhone(){
        $("#phoneNote").hide();    
        var phonenumber = $("#phonenumber").val();
        if(phonenumber.length != 0){
            if(!numberReg.test(phonenumber) || phonenumber.length != 10){
                $("#phonenumber").removeClass('ok').addClass('error');       
            }
            else{
                $.ajax({
                    url: "signup.php",
                    type: "POST",
                    async: false,
                    data: {"phonenumber": phonenumber },
                    success: function(result) {
                        if(result=="Ok"){
                            $("#phonenumber").removeClass('error').addClass('ok');
                            phoneFlag = true;
                        }
                        else{
                            $("#phonenumber").removeClass('ok').addClass('error');
                            $("#phoneNote").text(result).show();  
                            phoneFlag = false;
                        }                
                    }
                });
            }
        }
        return phoneFlag;     
    }

    function validateConfirmPassword(){
        var password = $("#password").val();
        var confirmPass = $("#cnfPassword").val();
        
        if(confirmPass.length != 0){
            if(password != confirmPass){
                $("#cnfPassword").removeClass('ok').addClass('error');  
                $("#confirmPassNote").show();
                confirmPasswordFlag = false;     
            }
            else{
                $("#confirmPassNote").hide();
                $("#cnfPassword").removeClass('error').addClass('ok');    
                confirmPasswordFlag = true;  
            }
        }
        else{
            $("#cnfPassword").removeClass('error').removeClass('ok');
        }
    }
    
    $("#signupDetails").submit(function(e) {
        var type = $("#btnSave").val();
        if(type == "Sign up"){
            validateConfirmPassword();
            if(validateUserID() && validatePhone()){               
                if(!(useridFlag && userNameFlag && passwordFlag && addressFlag && cardFlag && phoneFlag && confirmPasswordFlag)){
                    alert("Please verify the entered information.");
                    return;
                }
                else {
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
                }
            }
            else{
                alert("Please verify the entered information.");
                return;
            }
        } 
        else {
            if(validatePhone()){   
                validateConfirmPassword();            
                var check = $("#name").hasClass('error') + $("#phonenumber").hasClass('error') + $("#password").hasClass('error') + $("#card_info").hasClass('error') + $("#cnfPassword").hasClass('error');
                if(check != 0){
                    alert("Please verify the entered information.");
                    return;
                }
                else {
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
                }
            }
            else{
                alert("Please verify the entered information.");
                return;
            }
        }
               
    });


    var strength = {
        0: "Worst ☹",
        1: "Bad ☹",
        2: "Weak ☹",
        3: "Good ☺",
        4: "Strong ☻"
    }

    var password = document.getElementById('password');
    var meter = document.getElementById('password-strength-meter');
    var text = document.getElementById('password-strength-text');

    password.addEventListener('input', function(){
        var val = password.value;
        var result = zxcvbn(val);
        
        // Update the password strength meter
        meter.value = result.score;
    
        // Update the text indicator
        if(val !== "") {
            text.innerHTML = "Strength: " + "<strong>" + strength[result.score] + "</strong>" + "<span class='feedback'>" + result.feedback.warning + " " + result.feedback.suggestions + "</span"; 
        }
        else {
            text.innerHTML = "";
        }
    });

});

    
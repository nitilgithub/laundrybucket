
function setTimeOutfunction()
{
   // setTimeout(hideform, 1);
    hideform();
}
function hideform(){
     $('#request_free').removeAttr('style');
}

$(document).ready(function() {

    setTimeOutfunction();


    $('.anchor').click(function() {
			if($('#request_free').css("right")=='-303px')
	            $('#request_free').animate({right:-3},250);
			else
				$('#request_free').animate({right:-303},250);
    });
	
	$('.testiCol').quovolver();	
	
});
        function isInteger(s) {
            var i;
            for (i = 0; i < s.length; i++) {
                var c = s.charAt(i);
                if (((c < "0") || (c > "9"))) return false;
            }
            return true;
        }
       // function IsValidEmail(email) {
         //   var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
           // return expr.test(email);
       // };

        function checkall1() {
            var Name = document.getElementById('txt_name');
            var mobile = document.getElementById('txt_phone');
            var msg = document.getElementById('txt_message');

            var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            var reg_digit = "^[0-9]$";

            if (Name.value == "") {
                alert("Please Enter Name.");
                Name.focus();
                return false;
            }

            else if (Name.value == "Name") {
                alert("Please Enter Your Name.");
                Name.focus();
                return false;
            }
        
        
            else if (mobile.value == "Phone") {
                alert("Please Enter Mobile No.");
                mobile.focus();
                return false;
            }

            else if (mobile.value == "") {
                alert("Please Enter Mobile No.");
                mobile.focus();
                return false;
            }
            else if (isInteger(mobile.value) == false) {
                alert("Please Enter Digit Only.");
                mobile.focus();
                return false;
            }



            else if (mobile.value.length < 10) {
               alert("Please Enter 10 Digits Mobile No.");
                mobile.focus();
               return false;
           }
           
            else if (msg.value == "Message") {
                alert("Please Enter Message.");
                msg.focus();
                return false;
            }


            else if (msg.value == "") {
                alert("Please Enter Message.");
                address.focus();
                return false;
            }
             
            else if (captcha.value == "Enter Answer") {
                alert("Please Enter Answer.");
                captcha.focus();
                return false;

            }

            else {
                return true;
            }
        }


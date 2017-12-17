  var specialKeys = new Array();
  specialKeys.push(8); //Backspace
  specialKeys.push(9); //Backspace
  specialKeys.push(46); //Backspace
  specialKeys.push(27); //Backspace
  // http://www.w3resource.com/javascript/form/phone-no-validation.php#
    function validdateform(txtname,txtemail,txtphone,txtpass,txtconfmpass)  
    {  
    	 var ret=false;
    	 var blnphone=false;
    	 var blnname=false;
    	 var blnemail=false;
    	 var blnpass=false;
    	 var blnconfmpass=false;
    	 
    	 if(phonenumber(txtphone)==true)
    	 {
    	 	blnphone=true;
    	 }
    	 else
    	 {
    	 	blnphone=false;
    	    document.getElementById("error").style.display = ret ? "none" : "inline";
    	 }
    	
    	 if(usname(txtname)==true)
    	 {
    	 	blnname=true;
    	 }
    	 else
    	 {
    	 	blnname=false;
    	 	 document.getElementById("nameerr").style.display = ret ? "none" : "inline";
    	 }
    	 
    	  if(ValidateEmail(txtemail)==true)
    	 {
    	 	blnemail=true;
    	 }
    	 else
    	 {
    	 	blnemail=false;
    	 	 document.getElementById("emailerr").style.display = ret ? "none" : "inline";
    	 }
    	 
    	  if(ValidatePass(txtpass)==true)
    	 {
    	 	blnpass=true;
    	 }
    	 else
    	 {
    	 	blnpass=false;
    	 	 document.getElementById("passerr").style.display = ret ? "none" : "inline";
    	 }
    	 
    	   if(ConfmPass(txtpass)==true)
    	 {
    	 	blnconfmpass=true;
    	 }
    	 else
    	 {
    	 	blnconfmpass=false;
    	 	 document.getElementById("conpasserr").style.display = ret ? "none" : "inline";
    	 }
    	 
    	 if(blnphone==true && blnname==true && blnemail==true && blnpass==true && blnconfmpass==true)
    	 ret=true;	
    	 else
    	 ret=false;
    	 
    	 
    	 return ret;
  	}
  	
  	 function validateorderform(txtname,txtemail,txtphone,txtlaundry,txtdryclean)  
    {  
    	 var ret=false;
    	 var blnphone=false;
    	 var blnname=false;
    	 var blnemail=false;
    	 var blnlaund=false;
    	 
    	 if(txtlaundry.checked==false && txtdryclean.checked==false)
    	 {
    	 	blnlaund=false;
    	 	alert("Select at least 1 ordertype");
    	 	document.getElementById("chkerror").style.display = ret ? "none" : "inline";
    	 }
    	 else
    	 {
    	 	blnlaund=true;
    	 }
    	
    	 
    	 if(phonenumber(txtphone)==true)
    	 {
    	 	blnphone=true;
    	 }
    	 else
    	 {
    	 	blnphone=false;
    	    document.getElementById("error").style.display = ret ? "none" : "inline";
    	 }
    	
    	 if(usname(txtname)==true)
    	 {
    	 	blnname=true;
    	 }
    	 else
    	 {
    	 	blnname=false;
    	 	 document.getElementById("nameerr").style.display = ret ? "none" : "inline";
    	 }
    	 
    	  if(ValidateEmail(txtemail)==true)
    	 {
    	 	blnemail=true;
    	 }
    	 else
    	 {
    	 	blnemail=false;
    	 	 document.getElementById("emailerr").style.display = ret ? "none" : "inline";
    	 }
    	 
    	 
    	 
    	   
    	 
    	 if(blnphone==true && blnname==true && blnemail==true && blnlaund==true)
    	 ret=true;	
    	 else
    	 ret=false;
    	 
    	 
    	 return ret;
  	}
  
    function phonenumber(inputtxt)  
    {  
    	
      var phoneno = /^\d{10}$/;
       var ret=inputtxt.value.match(phoneno);
       if(ret==null)
       ret=false;
       else
       ret=true;
       document.getElementById("error").style.display = ret ? "none" : "inline";
       return ret;
    }  
      
      
       function usname(inputtxt)  
    {  
    	var ret;
      var usname = /^[a-zA-Z ]*$/;
      //var usname_len=inputtxt.value.length;
      
       var res=inputtxt.value.match(usname);
       if(res==null)
       ret=false;
       else
       ret=true;
       document.getElementById("nameerr").style.display = ret ? "none" : "inline";
       return ret;
    }  
    
    
      
       
       function ValidateEmail(inputtxt)  
    {  
      var mailformat =/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      var ret=inputtxt.value.match(mailformat);
       if(ret==null)
       ret=false;
       else
       ret=true;
       document.getElementById("emailerr").style.display = ret ? "none" : "inline";
       return ret;
    } 
    
    
        function ValidatePass(inputtxt)  
    {  
      //alert(pass);
      var ret;
      var passid_len=inputtxt.value.length;
      if( passid_len < 4)
      	ret=false;
       else
       ret=true;
       document.getElementById("passerr").style.display = ret ? "none" : "inline";
       
       return ret;
    }  
       
    
     function ConfmPass(inputtxt)  
    {  
      var pass =document.signup.crpass.value;
      //alert(pass);
      var ret=inputtxt.value.match(pass);
       if(ret==null)
       ret=false;
       else
       ret=true;
       document.getElementById("conpasserr").style.display = ret ? "none" : "inline";
       return ret;
    }  
      
      
      
  
        function IsNumeric(e) {
        	var keyCode = e.which ? e.which : e.keyCode
            var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
            return ret;
        }
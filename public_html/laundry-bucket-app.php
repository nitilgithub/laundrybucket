<?php include('header.php');?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	
getMobileOperatingSystem();
});
	function getMobileOperatingSystem() {
  var userAgent = navigator.userAgent || navigator.vendor || window.opera;

      // Windows Phone must come first because its UA also contains "Android"
    if (/windows phone/i.test(userAgent)) {
        //return "Windows Phone";
        alert("App not available on Windows store. Only available for iOS and Android");
        window.close();
    }

    if (/android/i.test(userAgent)) {
        window.location.href="https://play.google.com/store/apps/details?id=com.laundrybucket.app";
    }

    // iOS detection from: http://stackoverflow.com/a/9039885/177710
    if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
       window.location.href="https://itunes.apple.com/in/app/laundry-bucket/id1265429011?mt=8";
    }

if (navigator.appVersion.indexOf("Win")!=-1)
{
	window.location.href="https://play.google.com/store/apps/details?id=com.laundrybucket.app";
}
if (navigator.appVersion.indexOf("Mac")!=-1){
	window.location.href="https://itunes.apple.com/in/app/laundry-bucket/id1265429011?mt=8";
}

    
}

</script>
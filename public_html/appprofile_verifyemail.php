<?php
include 'header.php';
include '../api.laundrybucket.co.in/connection2.php';
$link = mysqli_connect($servername, $username, $password,$db);
	if (!$link) {
	    die("Connection failed: " . mysqli_connect_error());
	}
 $return_arr = array();

$uid=mysql_real_escape_string($_GET["u"]);
 $uemail=mysql_real_escape_string($_GET["ue"]);
$fetch_userotp=mysql_real_escape_string($_GET["ot"]);
$updatedby="user";
 

				$ch = curl_init();
				$url= "https://api.laundrybucket.co.in/mobileapp_api/profile_verifyemail.php?ot=$fetch_userotp&u=$uid&ue=$uemail";
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //use to hide curl sms send response
			
				$result=curl_exec($ch);
				//echo $result;
				curl_close($ch);

	?>	
<div class="container">

	<div class="row">

		<div>&nbsp;</div>

		<div>&nbsp;</div>

		</div>

	</div>

<section  class="mbr-section mbr-section--relative mbr-parallax-background" id="msg-box4-23" style="background-image: url(assets/images/slide-51024x521-151.jpg);">

    <div class="mbr-overlay"  style="opacity: 0.9; background-color: rgb(34, 34, 34);"></div>

    <div class="mbr-section__container mbr-section__container--isolated container" >

        <div class="row"  style="margin-bottom: 160px">

            

                <div class="mbr-box__magnet mbr-class-mbr-box_col-sm-12">

                    <div class="mbr-section__container mbr-section__container--middle">

                        <div class="mbr-header mbr-header--auto-align mbr-header--wysiwyg">

	                            <!--<h3 class="mbr-header__text" style="text-align: center" >Thank You<br></h3>-->

                            

                        </div>

                    </div>

                    <div class="mbr-section__container mbr-section__container--middle">

                        <div class="mbr-article mbr-article--auto-align mbr-article--wysiwyg"><p style="text-align: center">

                        <?php
                        
                        $array = json_decode($result, true);
					
						foreach($array as $key => $value)
						{
						   echo "<h3 class='text-center' style='color:white'>".$value['message'] . '</h3>';
						   // etc
						}
						?>
                        

                        	

                        	<a href="index.php" class="btn btn-info"> OK</a>

                        </p><p><br></p></div>

                    </div>

                    

                </div>

                

            </div>

        </div>

    </div>

    

</section>

<div class="container">

	<div>&nbsp;</div>

	</div>		
	
 

 	
<?php
include 'footer.php';
?>

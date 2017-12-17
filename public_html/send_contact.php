<?php
			include 'connection.php';
			error_reporting(0);
			require 'class.phpmailer.php';
            require 'class.smtp.php';
			$name=mysql_real_escape_string($_GET["name"]);
			$email=mysql_real_escape_string($_GET["email"]);
			$msg=mysql_real_escape_string($_GET["message"]);
			$phone=mysql_real_escape_string($_GET["phone"]);
			$enqtype=mysql_real_escape_string($_GET["enqtype"]);
			$error=array();
			if(empty($name) || empty($email) || ($enqtype==-1))
			{
				$error[]="Please enter required information. eg. Name and Email and Select Enquiry Type are required.";
			}
			else {
				
				if(!preg_match("/^[a-zA-Z ]+$/", $name))
				{
					$error[]="Invalid Username";
				}
				if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
					$error[]="Invalid Email";
				}
				
			}
		
			if(!empty($error))
			{
				foreach($error as $val){
					echo $val;
				}
				
			}
			else
					{
						$result=mysql_query("insert into tbl_contactenquiry(name,email,phone,enquirytype,message,addon) values('$name','$email','$phone','$enqtype','$msg',NOW())") or die(mysql_error());
						if(mysql_affected_rows())
						{
								$mail = new PHPMailer(); // create a new object
								$mail->IsSMTP(); // enable SMTP
								$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
								$mail->SMTPAuth = true; // authentication enabled
								$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
								$mail->Host = "mail.laundrybucket.co.in";
								$mail->Port = 465; // or 587
								$mail->IsHTML(true);
								$mail->Username = "sales@laundrybucket.co.in"; //gmail email here
								$mail->FromName = 'Laundry Ticket';
								$mail->Password = "sgda61gJxlz7"; //gmail password here
								$mail->SetFrom($email,$name); //from Address here
								$mail->AddReplyTo($email, 'Laundry Ticket');
								$mail->Subject = "Business Enquiry";
								$mail->Body = "name is : ".$name. "<br/>"."Email is : ".$email. "<br/>"."Mobile No. : ".$phone."<br/>"."Enquiry Type : ".$enqtype."<br/>"."Message is ".$msg;
								$mail->AddAddress("admin@laundrybucket.co.in"); //Email to
								$mail->AddCC("support@laundrybuckethelp.zendesk.com", 'cc account');
								
								if($mail->Send())
								    {
								    echo 1;
								   //echo "Message Sent Successfully";
								   //header("location:thanksconatct.php");
									//exit;
								    }
								    else
								    {
								      echo "Error, While Sending Message.";
								    }
						   }
						}
									?>	
<?php
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Merchant Check Out Page</title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" name="viewport" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

</head>
<body>
	<div class="container">
		<div class="row">
			<div>&nbsp;</div>
			<div>&nbsp;</div>
			<center>
			<img src="https://laundrybucket.co.in/assets/images/img-1959-copy491x213-160.png" class="img-responsive" />
			</center>
			
	      <div class="col-md-12 col-xs-12 col-sm-12">
	      	<div align="center">Verify Your Details</div>
	      </div>
	      <div class="col-md-12 col-xs-12 col-sm-12"> 
	<form method="post" action="pgRedirect.php">
		<input type="hidden" id="ORDER_ID" tabindex="1" maxlength="20" size="20"
						name="ORDER_ID" autocomplete="off"
						value="<?php echo $_GET["ORDER_ID"]; ?>">
		<input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="<?php echo $_GET["CUST_ID"]; ?>">
		<input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
		<input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
		<input type="hidden" title="TXN_AMOUNT" tabindex="10"	type="text" name="TXN_AMOUNT" value="<?php echo $_GET["TXN_AMOUNT"]; ?>">				
						
		<table class="table table-bordered table-responsive">
			<tbody>
				<tr>
					<td><label>ORDER_ID:*</label></td>
					<td><?php echo $_GET["ORDER_ID"]; ?></td>
				</tr>
				<tr>
					
					<td><label>CUSTID:*</label></td>
					<td><?php echo $_GET["CUST_ID"]; ?></td>
				</tr>
				<tr>
					<td><label>txnAmount*</label></td>
					<td><?php echo $_GET["TXN_AMOUNT"]; ?></td>
				</tr>
				<tr>
					
					<td colspan="2"><input value="Pay Now" class="btn btn-info btn-block" type="submit" onclick=""></td>
				</tr>
			</tbody>
		</table>
		
	</form>
	</div>
	 <div class="col-md-12 col-xs-12 col-sm-12">
	 	 
	 	</div>
	</div>
	</div>
</body>
</html>
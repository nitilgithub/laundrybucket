<?php 
include 'header.php';
$uid=$_GET["uid"];
if(isset($_GET["ohstatus"])) //ohstatus stands for-Order History Stautus
{
	echo "<script>alert('No Order Found');</script>";
echo "<script>setTimeout(\"location.href = 'reguserlist_new.php';\",2000);</script>";
}

if(isset($_POST['btnView']))
{
	$val=mysql_real_escape_string($_POST['numusers']);
	
	
	
	$url="webservice_reguserlist.php?v=".$val;
	
	
}
else {
	if(isset($_GET["uid"])){ $v="uid=".$uid;} else{ $v="";}
	$url="webservice_reguserlist.php?v=10&".$v;
	$title="All";
}

?>
<script>
	function actionFormatter(value, row, index) {
    return [
        '<a class="btnedit btn btn-primary btn-xs" href="javascript:void(0)" title="edit">', '<i class="glyphicon glyphicon-edit"> </i>',' ',
        'EDIT',
        '</a>',
        '<a class="btndel btn btn-danger btn-xs" href="javascript:void(0)" title="Edit">', '<i class="fa fa-trash-o"></i>', ' ',
        'Delete',
        '</a>',
         '<a class="btnorderhistory btn btn-info btn-xs" href="javascript:void(0)" title="Order History">', '<i class="fa fa-history"></i>', ' ',
        'Order History',
        '</a>',
        '<a class="btnorderdashboard btn btn-info btn-xs" href="javascript:void(0)" title="Order Dashboard">', '<i class="fa fa-history"></i>', ' ',
        'Order Dashboard',
        '</a>',
        
        '<br/>', '<br/>',
         '<a class="btncreateorder btn btn-success btn-xs" href="javascript:void(0)" title="Create New Order">', '<i class="fa fa-plus-square"></i>', ' ',
        'create order',
        '</a>',
         '<a class="btncreateusersubs btn btn-success btn-xs" href="javascript:void(0)" title="Create New User Subscription">', '<i class="fa fa-plus-square"></i>', ' ',
        'create User Subscription',
        '</a>',
        '<a class="btnusersubs btn btn-info btn-xs" href="javascript:void(0)" title="Subscription History">', '<i class="fa fa-history"></i>', ' ',
        'Subscription History',
        '</a>'
        
    ].join('');
}

function actionFormatter1(value, row, index) {
    return [
        '<a class="btnedit btn btn-primary btn-xs" href="javascript:void(0)" title="edit">', '<i class="glyphicon glyphicon-edit"> </i>',' ',
        'EDIT',
        '</a>',
        
         '<a class="btnorderhistory btn btn-info btn-xs" href="javascript:void(0)" title="Order History">', '<i class="fa fa-history"></i>', ' ',
        'Order History',
        '</a>',
        '<a class="btnorderdashboard btn btn-info btn-xs" href="javascript:void(0)" title="Order Dashboard">', '<i class="fa fa-history"></i>', ' ',
        'Order Dashboard',
        '</a>',
        
        '<br/>', '<br/>',
         '<a class="btncreateorder btn btn-success btn-xs" href="javascript:void(0)" title="Create New Order">', '<i class="fa fa-plus-square"></i>', ' ',
        'create order',
        '</a>',
         '<a class="btncreateusersubs btn btn-success btn-xs" href="javascript:void(0)" title="Create New User Subscription">', '<i class="fa fa-plus-square"></i>', ' ',
        'create User Subscription',
        '</a>',
         '<a class="btnusersubs btn btn-info btn-xs" href="javascript:void(0)" title="Subscription History">', '<i class="fa fa-history"></i>', ' ',
        'Subscription History',
        '</a>'
        
    ].join('');
}

window.actionEvents = {
    'click .btnedit': function (e, value, row, index) {
        window.location.href="update_reguser.php?id="+row.id;
    },
    'click .btndel': function (e, value, row, index) {
    	  var r=confirm("Do you really want to Delete this User");
  		if(r==true)
  		{
  		 window.location.href="delete_reguser.php?id="+row.id;
  		}
  		else
  		{
  			return false;
  		}
       
    },
    
      'click .btnorderhistory': function (e, value, row, index) {
        window.location.href="user_orderhistory_new.php?id="+row.id;
    },
     'click .btnorderdashboard': function (e, value, row, index) {
        window.location.href="order_dashboard.php?uid="+row.id;
    },
    
     'click .btncreateorder': function (e, value, row, index) {
        window.location.href="place_order.php?uid="+row.id;        //window.location.href="create_order.php?userid="+row.id;
    },
    
    'click .btncreateusersubs': function (e, value, row, index) {
        window.location.href="create_usersubscription.php?userid="+row.id;
    },
    
     'click .btnusersubs': function (e, value, row, index) {
        window.location.href="view_usersubscription.php?userid="+row.id;
    }
};


        
    $(function () {
        $('#remove').click(function () {
            var ids = $.map($('#table').bootstrapTable('getSelections'), function (row) {
            	
                var did=row.id;
                var uri="delete_reguser.php?id="+did+"&op=1";
              //  alert(uri);
               var r=confirm("Do you really want to Delete this User");
  		if(r==true)
  		{
  		 //window.location.href="delete_reguser.php?id="+row.id;
  		  $.get(uri,function(result){
			    //   alert(result);
			    });
  		}
  		else
  		{
  			return false;
  		}
               
                return row.id;
                
            });
            //alert(ids);
            
            $('#table').bootstrapTable('remove', {
                field: 'id',
                values: ids
            });
            
           //  $('#remove').prop('disabled', true);
        });
    });
</script>

<style>
	@media screen and (max-width: 600px) {
table {width:100%;}
thead {display: none !important;}
tr:nth-of-type(2n) {background-color: inherit;}
tr td:first-child {background: #f0f0f0; font-weight:bold;font-size:1.3em;}
tbody td {display: block; }

  td:nth-of-type(3):before { 
    content: 'Reg Date:' ; 
    display: block;
     
  }
  td:nth-of-type(4):before { 
    content: 'User Type:' ; 
    display: block;
     
  }
  td:nth-of-type(5):before { 
    content: 'Sales Channel:' ; 
    display: block;
     
  }
  
}
</style>

            <!-- page content -->
            <div class="right_col" role="main">

                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Registered Users</h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>

                    <div class="">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel tile">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Users Detail </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                       
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
      
                                <div class="x_content table-responsive">
        <?php
        if(!isset($_GET['uid']))
		{
        ?>                       	
      <form method="post">
      	<input type="number" placeholder="No. of users to view" name="numusers" />
      	<input type="submit" class="btn btn-primary btn-sm" name="btnView" value="View">
      </form>
        <?php
		}
        ?>            
 <div class="fixed-table-toolbar">
 	
  <div class="columns columns-left btn-group pull-left">
  	  <?php if($_SESSION['loginrole']==2)
		  {
		  ?>
  	  <button id="remove" class="btn btn-danger" >
            <i class="glyphicon glyphicon-remove"></i> Delete
</button>
<?php } ?>
  </div>
  

						<table data-toggle="table" id="table" data-url="<?php echo $url; ?>" data-pagination="true" data-show-refresh="true" data-show-toggle="true"  data-show-columns="true" data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true">
      
     
    <thead>
    <tr>
        <th data-field=" " data-checkbox="true"></th>
        
        <th data-field="client_detail">User</th>
        
        
        <!--<th data-field="id" data-align="left" data-sortable="true">ID</th>
          <th data-field="name" data-align="left" class="text-capitalize">Name</th>
          <th data-field="email" data-align="center">Email</th>
          <th data-field="mobile" data-align="left">Mobile</th>
          <th data-field="address" data-align="left">Address</th>-->
          
          <th data-field="regdate">Reg Date</th>
          <th data-field="usertype" data-align="left">User Type</th>
          <th data-field="reference" data-align="left">Sales Channel</th>
          <th data-field="action" data-formatter="actionFormatter" data-events="actionEvents">Action</th>
          
          
          
          <?php/* if($_SESSION['loginrole']==2)
		  {
		  ?>
          <th data-field="action" data-formatter="actionFormatter" data-events="actionEvents">Action</th>
          <?php } else {
          	?>
          	 <th data-field="action" data-formatter="actionFormatter1" data-events="actionEvents">Action</th>
          	<?php
          }*/?>
          
         
    </tr>
    </thead>
</table>

                                </div>
                            </div>
                        </div>
</div>
</div>
</div>
</div>

<?php include 'footer.php'; ?>
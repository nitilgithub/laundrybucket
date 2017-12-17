<?php 
include 'header.php';
$uid=mysql_real_escape_string($_GET["uid"]);
if(isset($_GET["ohstatus"])) //ohstatus stands for-Order History Stautus
{
	echo "<script>alert('No Order Found');</script>";
echo "<script>setTimeout(\"location.href = 'reguserlist.php';\",2000);</script>";
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
        
        '<br/>', '<br/>',
         '<a class="btncreateorder btn btn-success btn-xs" href="javascript:void(0)" title="Create New Order">', '<i class="fa fa-plus-square"></i>', ' ',
        'create order',
        '</a>',
         '<a class="btncreateusersubs btn btn-success btn-xs" href="javascript:void(0)" title="Create New User Subscription">', '<i class="fa fa-plus-square"></i>', ' ',
        'create User Subscription',
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
        window.location.href="user_orderhistory.php?id="+row.id;
    },
    
     'click .btncreateorder': function (e, value, row, index) {
        window.location.href="create_order.php?userid="+row.id;
    },
    
    'click .btncreateusersubs': function (e, value, row, index) {
        window.location.href="create_usersubscription.php?userid="+row.id;
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
      
                    
 <div class="fixed-table-toolbar">
 	
  <div class="columns columns-left btn-group pull-left">
  	  <button id="remove" class="btn btn-danger" >
            <i class="glyphicon glyphicon-remove"></i> Delete
</button>&nbsp;&nbsp;&nbsp;<a href="phpexceldownload/users.php"  class="btn btn-primary">Excel</a>
  </div>
  

						<table data-toggle="table" id="table" data-url="webservice_reguserlist.php?<?php if(isset($_GET["uid"])){ echo "uid=".$uid;} else{ } ?>" data-pagination="true" data-show-refresh="true" data-show-toggle="true"  data-show-columns="true" data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true">
      
     
    <thead>
    <tr>
        <th data-field=" " data-checkbox="true"></th>
        <th data-field="id" data-align="left" data-sortable="true">ID</th>
        <th data-field="usertype" data-align="left" class="text-capitalize">User Type</th>
          <th data-field="name" data-align="left" class="text-capitalize">Name</th>
          <th data-field="email" data-align="center">Email</th>
          <th data-field="mobile" data-align="left">Mobile</th>
          <th data-field="address" data-align="left">Address</th>
          <th data-field="regdate">Reg Date</th>
          <th data-field="action" data-formatter="actionFormatter" data-events="actionEvents">Action</th>
         
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
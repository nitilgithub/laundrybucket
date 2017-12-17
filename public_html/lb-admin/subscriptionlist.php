<?php include 'header.php';?>
<script>
	function actionFormatter(value, row, index) {
    return [
        '<a class="btnedit btn btn-info  btn-xs" href="javascript:void(0)" title="edit">', '<i class="glyphicon glyphicon-edit"> </i>',' ',
        'EDIT',
        '</a>',
        '<a class="btndel btn btn-danger btn-xs" href="javascript:void(0)" title="Edit">', '<i class="fa fa-trash-o"></i>', ' ',
        'Delete',
        '</a>'
    ].join('');
}

window.actionEvents = {
    'click .btnedit': function (e, value, row, index) {
        window.location.href="update_subscription.php?id="+row.id;
    },
    'click .btndel': function (e, value, row, index) {
        window.location.href="delete_subscription.php?id="+row.id;
    }
};


        
    $(function () {
        $('#remove').click(function () {
            var ids = $.map($('#tablesubscription').bootstrapTable('getSelections'), function (row) {
                var did=row.id;
                var uri="delete_subscription.php?id="+did+"&op=1";
              //  alert(uri);
                $.get(uri,function(result){
			    //   alert(result);
			    });
                return row.id;
                
            });
            //alert(ids);
            
            $('#tablesubscription').bootstrapTable('remove', {
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
                            <h3> Subscriptions </h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>

                    <div class="">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel tile">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Subscription List </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                       
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content table-responsive">
      
                    
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
  

						<table data-toggle="table" id="tablesubscription" data-url="webservice_subscriptionlist.php" data-pagination="true" data-show-refresh="true" data-show-toggle="true"  data-show-columns="true" data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true">
      
     
    <thead>
    <tr>				
    	<?php if($_SESSION['loginrole']==2)
		  {
		  ?>	
    	<th data-field="action" data-formatter="actionFormatter" data-events="actionEvents">Action</th>			
    	<?php } ?>
    	
	      <th data-field=" " data-checkbox="true"></th>        
	      
	      <th data-field="id" data-align="left" data-sortable="true">ID</th>
          <th data-field="subs_name" data-align="center">Subscription Name</th>                    
          
          <th data-field="subs_servicetype" data-align="center">Subscription Service</th>                    
          
          <th data-field="subs_garmenttype" data-align="center">Subscription Garment</th>
          <th data-field="subs_cost" data-align="center">Subscription Cost</th>
          
           <th data-field="validity" data-align="center">Validity</th>
          <th data-field="subs_weight" data-align="center">Subscription Weight</th>
          
           <th data-field="subs_extra_wt_cost" data-align="center">Extra Weight Cost<br>(per kg)</th>  
           
          <th data-field="subs_maxpickup" data-align="center">Subs_maxpickup</th>
          
           <th data-field="subs_extra_pickup_cost" data-align="center">Extra Pickup Cost<br>(per pickup)</th>     
          
                            
          
          <th data-field="subs_remarks" data-align="center">Remarks</th>

    </tr>
    </thead>
</table>

                                </div>
                            </div>
                        </div>


<?php include 'footer.php'; ?>
<?php include 'header.php';?>

<script>

	function actionFormatter(value, row, index) {

	if(row.notify==1){
		return [

        '<a class="btnedit btn btn-info  btn-xs" href="javascript:void(0)" title="edit">', '<i class="glyphicon glyphicon-edit"> </i>',' ',

        'EDIT',

        '</a>',

        '<a class="btndel btn btn-danger btn-xs" href="javascript:void(0)" title="Delete">', '<i class="fa fa-trash-o"></i>', ' ',

        'Delete',

        '</a>',
        '<a class="btnnotify btn btn-warning btn-xs" href="javascript:void(0)" title="Notification">', '<i class="fa fa-bell"></i>', ' ',

        'Send Notification & Message',

        '</a>'

    ].join('');
	}
	else
	{
    return [

        '<a class="btnedit btn btn-info  btn-xs" href="javascript:void(0)" title="edit">', '<i class="glyphicon glyphicon-edit"> </i>',' ',

        'EDIT',

        '</a>',

        '<a class="btndel btn btn-danger btn-xs" href="javascript:void(0)" title="Delete">', '<i class="fa fa-trash-o"></i>', ' ',

        'Delete',

        '</a>'

    ].join('');
   }

}



window.actionEvents = {

    'click .btnedit': function (e, value, row, index) {

        window.location.href="update_offer.php?id="+row.id;

    },

    'click .btndel': function (e, value, row, index) {
    	
    	var r=confirm("Do you really want to Delete this Offer");
  		if(r==true)
  		{
  		 window.location.href="delete_offer.php?id="+row.id;
  		}
  		else
  		{
  			return false;
  		}

    },
    
    'click .btnnotify': function (e, value, row, index) {
    	
    	var r=confirm("Do you really want to notify all app users about this offer");
  		if(r==true)
  		{
  			$('#myModal').modal('show');
  		 $("#nmesg").val(row.nmesg);
  		 $("#nid").val(row.id);
  		}
  		else
  		{
  			return false;
  		}

    }

};





        

    $(function () {

        $('#remove').click(function () {

            var ids = $.map($('#tableitem').bootstrapTable('getSelections'), function (row) {

                var did=row.id;

                var uri="delete_offer.php?id="+did+"&op=1";

              //  alert(uri);

                $.get(uri,function(result){

			    //   alert(result);

			    });

                return row.id;

                

            });

            //alert(ids);

            

            $('#tableitem').bootstrapTable('remove', {

                field: 'id',

                values: ids

            });

            

           //  $('#remove').prop('disabled', true);

        });

    });

  $(document).on("click","#btnSend",function(){
  	var title=$("#ntitle").val();
  	var mesg=$("#nmesg").val();
  	var nid=$("#nid").val();
  	//alert(title);
  	//alert(mesg);
  	$.ajax({
  		type:"GET",
  		dataType: "json",
  		url:"offer_notification.php?title="+title+"&pushmesg="+mesg+"&nid="+nid,
  		success:function(data){
  			$.each(data,function(i,field){
  				if(field.response==1){
  				alert("Notification Sent");
  				location.reload();		
  				}	
  				else
  				{
  					alert("Notification Sent But unable to update the offer");
  					location.reload();
  				}	
  			});
  		}
  	});
  });

</script>



            <!-- page content -->

            <div class="right_col" role="main">



                <div class="">

                    <div class="page-title">

                        <div class="title_left">

                            <h3> Offers </h3>

                        </div>



                        

                    </div>

                    <div class="clearfix"></div>



                    <div class="">

                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <div class="x_panel tile">

                                <div class="x_title">

                                    <h2><i class="fa fa-bars"></i> All Offers </h2>

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

  



						<table data-toggle="table" id="tableitem" data-url="webservice_offer_list.php" data-pagination="true" data-show-refresh="true" data-show-toggle="true"  data-show-columns="true" data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true">

      

     

    <thead>

    <tr>

        <th data-field=" " data-checkbox="true"></th>

        <th data-field="id" data-align="left" data-sortable="true">ID</th>
   

          <th data-field="offer_code" data-align="center"> Offer Code</th>
          
           <th data-field="service_name" data-align="center">Order Type</th>

          <th data-field="offer_value" data-align="center" > Offer Value</th>

          <th data-field="offer_unit" data-align="center"> Offer Value Unit </th>
          
          <th data-field="validity" data-align="center"> Validity</th>
         
          <th data-field="start_date" data-align="center">Start Date</th>
          
           <th data-field="end_date" data-align="center">End Date</th>
           
            <th data-field="status" data-align="center">Status</th>
            
            <th data-field="description" data-align="center">Description</th>
            
           <?php if($_SESSION['loginrole']==2)
		  {
		  ?>

          <th data-field="action" data-formatter="actionFormatter" data-events="actionEvents">Action</th>
`		<?php } ?>
         

    </tr>

    </thead>

</table>



                                </div>

                            </div>

                        </div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Send Offer Notification</h4>
      </div>
      <div class="modal-body">
        <label>Title</label>
        <input type="text" name="ntitle" id="ntitle" value="New Offer" class="form-control" /><br>
        <label>Message</label>
        <input type="text" name="nmesg" id="nmesg"  class="form-control" />
        <input type="hidden" id="nid" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnSend" name="btnSend" >Send</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<?php include 'footer.php'; ?>
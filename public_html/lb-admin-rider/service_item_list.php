<?php include 'header.php';?>

<script>
 function imageFormatter(value, row) 
      {
      	if(value==null || value=='')
      	{
      		return '-';
      	}
      	else
      	{
      	var path='https://cdn.laundrybucket.co.in/images/'+value;
      	//alert(path);
      	return '<img style="width:60px;height:60px;" class="img-responsive img-thumbnail" src="'+path+'" />';
    	}
    }
    
   
	function actionFormatter(value, row, index) {

    return [

        '<a class="btnedit btn btn-info  btn-xs" href="javascript:void(0)" title="edit">', '<i class="glyphicon glyphicon-edit"> </i>',' ',

        'EDIT',

        '</a>',

        '<a class="btndel btn btn-danger btn-xs" href="javascript:void(0)" title="Delete">', '<i class="fa fa-trash-o"></i>', ' ',

        'Delete',

        '</a>'

    ].join('');

}



window.actionEvents = {

    'click .btnedit': function (e, value, row, index) {

        window.location.href="update_service_item.php?id="+row.id;

    },

    'click .btndel': function (e, value, row, index) {
    	
    	var r=confirm("Do you really want to Delete this Service");
  		if(r==true)
  		{
  		 window.location.href="delete_service_item.php?id="+row.id;
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

                var uri="delete_service_item.php?id="+did+"&op=1";

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

    

</script>



            <!-- page content -->

            <div class="right_col" role="main">



                <div class="">

                    <div class="page-title">

                        <div class="title_left">

                            <h3> Services </h3>

                        </div>



                        

                    </div>

                    <div class="clearfix"></div>



                    <div class="">

                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <div class="x_panel tile">

                                <div class="x_title">

                                    <h2><i class="fa fa-bars"></i> All Service Items </h2>

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

  



						<table data-toggle="table" id="tableitem" data-url="webservice_service_itemlist.php" data-pagination="true" data-show-refresh="true" data-show-toggle="true"  data-show-columns="true" data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true">

      

     

    <thead>

    <tr>

        <th data-field=" " data-checkbox="true"></th>

        <th data-field="id" data-align="left" data-sortable="true">ID</th>

       

          <th data-field="item_name" data-align="center"> Name</th>

          <th data-field="s_rate" data-align="center" > Standard Rate</th>

          <th data-field="p_rate" data-align="center"> Premium Rate </th>
          
          <th data-field="priceunit" data-align="center"> Price Unit </th>
          
          <th data-field="itemimage" data-align="center" data-formatter="imageFormatter"> Item </th>

          <th data-field="service_name" data-align="center">Service</th>
          
          <th data-field="service_cat" data-align="center">Service Category</th>
            <?php if($_SESSION['loginrole']==2)
		  {
		  ?>

          <th data-field="action" data-formatter="actionFormatter" data-events="actionEvents">Action</th>
		<?php } ?>
         

    </tr>

    </thead>

</table>



                                </div>

                            </div>

                        </div>





<?php include 'footer.php'; ?>
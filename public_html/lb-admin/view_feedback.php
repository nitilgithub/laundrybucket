<?php include 'header.php';?>

<script>

	function actionFormatter(value, row, index) {

    return [

       

        '<a class="btndel btn btn-danger btn-xs" href="javascript:void(0)" title="Delete">', '<i class="fa"></i>', ' ',

        'Action',

        '</a>'

    ].join('');

}



window.actionEvents = {

    

    'click .btndel': function (e, value, row, index) {
    	
    	

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

                            <h3> Customer Feedback </h3>

                        </div>



                        

                    </div>

                    <div class="clearfix"></div>



                    <div class="">

                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <div class="x_panel tile">

                                <div class="x_title">

                                    <h2><i class="fa fa-bars"></i>All Customer's Feedback </h2>

                                    <ul class="nav navbar-right panel_toolbox">

                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

                                        </li>

                                       

                                    </ul>

                                    <div class="clearfix"></div>

                                </div>

                                <div class="x_content table-responsive">

      

                    

 <div class="fixed-table-toolbar">

 	

  <div class="columns columns-left btn-group pull-left">

  	 <!-- <button id="remove" class="btn btn-danger" >

            <i class="glyphicon glyphicon-remove"></i> Delete

</button>-->

  </div>

  



						<table data-toggle="table" id="tableitem" data-url="webservice_feedbacklist.php" data-pagination="true" data-show-refresh="true" data-show-toggle="true"  data-show-columns="true" data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true">

      

     

    <thead>

    <tr>

        <th data-field=" " data-checkbox="true"></th>

        <!--<th data-field="userid" data-align="left" data-sortable="true">User Id</th>-->

       	<th data-field="orderid" data-align="left" data-sortable="true">Order Id</th>

          <th data-field="client_name" data-align="center">Client Name</th>

          <th data-field="client_email" data-align="center" >Client Email</th>

          <th data-field="client_mob" data-align="center">Client Mob</th>
          
          <th data-field="address" data-align="center"> Address</th>
          
          <th data-field="rating" data-align="center">Rating</th>

          <th data-field="product_exp" data-align="center">Product Experience</th>
          
          <th data-field="customer_service_rep" data-align="center">Customer Service Representative</th>
		
			<th data-field="recommend_to_friend" data-align="center">Recommend to friend</th>
			
			<th data-field="comment" data-align="center">Comment</th>
			
			<th data-field="receive_date" data-align="center">Feedback received on</th>
			
          <th data-field="action" data-formatter="actionFormatter" data-events="actionEvents">Action</th>

         

    </tr>

    </thead>

</table>



                                </div>

                            </div>

                        </div>





<?php include 'footer.php'; ?>
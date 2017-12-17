<?php include 'header.php';?>
<script>
	function actionFormatter(value, row, index) {
    return [
        /*'<a class="btnedit btn btn-info  btn-xs" href="javascript:void(0)" title="edit">', '<i class="glyphicon glyphicon-edit"> </i>',' ',
        'EDIT',
        '</a>',*/
        '<a class="btndel btn btn-danger btn-xs" href="javascript:void(0)" title="Edit">', '<i class="fa fa-trash-o"></i>', ' ',
        'Delete',
        '</a>'
    ].join('');
}

window.actionEvents = {
   
   /* 'click .btnedit': function (e, value, row, index) {
        window.location.href="update_customer.php?id="+row.id;
    },*/
    'click .btndel': function (e, value, row, index) {
        window.location.href="delete_querycontact.php?id="+row.id;
    }
};
</script>
            <!-- page content -->
            <div class="right_col" role="main">

                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Contact Us Query</h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>

                    <div class="">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel tile">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Query Detail </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                       
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content table-responsive">

						<table data-toggle="table" data-url="webservice_getcontactquery.php" data-pagination="true" data-show-refresh="true" data-show-toggle="true"  data-show-columns="true" data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true">
      
    <thead>
    <tr>
        <!--<th data-field=" " data-checkbox="true"></th>-->
        <th data-field="srno" data-align="left" data-sortable="true">ID</th>
        <th data-field="name" data-align="left">Name</th>
          <th data-field="email" data-align="center">Email</th>
          <th data-field="phone" data-align="center">Phone No.</th>                    <th data-field="enquirytpe" data-align="center">Enquiry Type</th>
      	   <th data-field="message">Message</th>
         <th data-field="date">Date</th>
          <th data-field="action" data-formatter="actionFormatter" data-events="actionEvents">Action</th>
         
    </tr>
    </thead>
</table>

                                </div>
                            </div>
                        </div>

                
<?php include 'footer.php'; ?>
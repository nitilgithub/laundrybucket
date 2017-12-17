<?php include 'header.php';?>
<script>
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
        window.location.href="update_product.php?id="+row.id;
    },
    'click .btndel': function (e, value, row, index) {
        window.location.href="delete_product.php?id="+row.id;
    }
};


        
    $(function () {
        $('#remove').click(function () {
            var ids = $.map($('#tableproduct').bootstrapTable('getSelections'), function (row) {
                var did=row.id;
                var uri="delete_product.php?id="+did+"&op=1";
              //  alert(uri);
                $.get(uri,function(result){
			    //   alert(result);
			    });
                return row.id;
                
            });
            //alert(ids);
            
            $('#tableproduct').bootstrapTable('remove', {
                field: 'id',
                values: ids
            });
            
           //  $('#remove').prop('disabled', true);
        });
    });
    
      function imageFormatter(value, row) 
      {
      	return '<img style="width:60px;height:60px;" class="img-responsive img-thumbnail" src="'+value+'" />';
    }
    
   
</script>

            <!-- page content -->
            <div class="right_col" role="main">

                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3> Products </h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>

                    <div class="">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel tile">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> All Products </h2>
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
</button>
  </div>
  

						<table data-toggle="table" id="tableproduct" data-url="webservice_productslist.php" data-pagination="true" data-show-refresh="true" data-show-toggle="true"  data-show-columns="true" data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true">
      
     
    <thead>
    <tr>
        <th data-field=" " data-checkbox="true"></th>
        <th data-field="id" data-align="left" data-sortable="true">ID</th>
       
          <th data-field="item_name" data-align="center"> Name</th>
          <th data-field="itemimage" data-align="center" data-formatter="imageFormatter"> Item </th>
          <th data-field="item_price" data-align="center"> Price </th>
          <th data-field="item_category" data-align="center">Category</th>
          <th data-field="action" data-formatter="actionFormatter" data-events="actionEvents">Action</th>
         
    </tr>
    </thead>
</table>

                                </div>
                            </div>
                        </div>


<?php include 'footer.php'; ?>
<div class="clearfix"></div>

                <!-- footer content -->
                <footer class="footer navbar-fixed-bottom" >
                    <div class="">
                        <p class="pull-right">Laundry Bucket!  bless your clothes for long life . |
                            <span class="lead"> <img src="../washingf.png"></img> Laundry Bucket!</span>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->

            </div>
            <!-- /page content -->
        </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

   <!-- <script src="js/bootstrap.min.js"></script>-->
 <script src="../assets/bootstrap-timepicker.js"></script>
  <script type="text/javascript">
            $('#timepicker2').timepicker();
        </script>
    <!-- chart js -->
    <script src="js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="js/icheck/icheck.min.js"></script>

    <script src="js/custom.js"></script>
    
     <script src="js/datatables/js/jquery.dataTables.js"></script>
        <script src="js/datatables/tools/js/dataTables.tableTools.js"></script>
        
          <script src="js/input_mask/jquery.inputmask.js"></script>
     <!-- input_mask -->
    <script>
        $(document).ready(function () {
            $(":input").inputmask();
            
        });
    </script>
    
     <!-- daterangepicker -->
        <script type="text/javascript" src="js/moment.min2.js"></script>
        <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>

  <script type="text/javascript">
                        $(document).ready(function () {
                            $('#datepicker').daterangepicker({
                                singleDatePicker: true,
                                calender_style: "picker_4",
                                 //showDropdowns: true
                            }, function (start, end, label) {                            									
                            	var pickdate=start.format('MM-DD-YYYY');
                                console.log(start.toISOString(), end.toISOString(), label);							
                            });
                        });
                        
                          $(document).ready(function () {
                            $('#datepicker2').daterangepicker({
                                singleDatePicker: true,
                                calender_style: "picker_4",
                                 //showDropdowns: true
                            }, function (start, end, label) {
                                console.log(start.toISOString(), end.toISOString(), label);
                            });
                        });
                        $(document).ready(function () {
                            $('#datepicker3').daterangepicker({
                                singleDatePicker: true,
                                calender_style: "picker_4",
                                 //showDropdowns: true
                            }, function (start, end, label) {
                                console.log(start.toISOString(), end.toISOString(), label);
                            });
                        });
                        $(document).ready(function () {
                            $('#datepicker4').daterangepicker({
                                singleDatePicker: true,
                                calender_style: "picker_4",
                                 //showDropdowns: true
                            }, function (start, end, label) {
                                console.log(start.toISOString(), end.toISOString(), label);
                            });
                        });
                        $(document).ready(function () {
                            $('.datepicker').daterangepicker({
                                singleDatePicker: true,
                                calender_style: "picker_4",
                                 //showDropdowns: true
                            }, function (start, end, label) {
                                console.log(start.toISOString(), end.toISOString(), label);
                            });
                        });
                        $(document).ready(function () {
                            $('.datepicker1').daterangepicker({
                                singleDatePicker: true,
                                calender_style: "picker_4",
                                 //showDropdowns: true
                            }, function (start, end, label) {
                                console.log(start.toISOString(), end.toISOString(), label);
                            });
                        });
                    </script>
        
    <!-- PNotify -->
    <script type="text/javascript" src="js/notify/pnotify.core.js"></script>
    <script type="text/javascript" src="js/notify/pnotify.buttons.js"></script>
    <script type="text/javascript" src="js/notify/pnotify.nonblock.js"></script>

    <script>
        $(function () {
            var cnt = 10; //$("#custom_notifications ul.notifications li").length + 1;
            TabbedNotification = function (options) {
                var message = "<div id='ntf" + cnt + "' class='text alert-" + options.type + "' style='display:none'><h2><i class='fa fa-bell'></i> " + options.title + "</h2><div class='close'><a href='javascript:;' class='notification_close'><i class='fa fa-close'></i></a></div><p>" + options.text + "</p></div>";

                if (document.getElementById('custom_notifications') == null) {
                    alert('doesnt exists');
                } else {
                    $('#custom_notifications ul.notifications').append("<li><a id='ntlink" + cnt + "' class='alert-" + options.type + "' href='#ntf" + cnt + "'><i class='fa fa-bell animated shake'></i></a></li>");
                    $('#custom_notifications #notif-group').append(message);
                    cnt++;
                    CustomTabs(options);
                }
            }

            CustomTabs = function (options) {
                $('.tabbed_notifications > div').hide();
                $('.tabbed_notifications > div:first-of-type').show();
                $('#custom_notifications').removeClass('dsp_none');
                $('.notifications a').click(function (e) {
                    e.preventDefault();
                    var $this = $(this),
                        tabbed_notifications = '#' + $this.parents('.notifications').data('tabbed_notifications'),
                        others = $this.closest('li').siblings().children('a'),
                        target = $this.attr('href');
                    others.removeClass('active');
                    $this.addClass('active');
                    $(tabbed_notifications).children('div').hide();
                    $(target).show();
                });
            }

            CustomTabs();

            var tabid = idname = '';
            $(document).on('click', '.notification_close', function (e) {
                idname = $(this).parent().parent().attr("id");
                tabid = idname.substr(-2);
                $('#ntf' + tabid).remove();
                $('#ntlink' + tabid).parent().remove();
                $('.notifications a').first().addClass('active');
                $('#notif-group div').first().css('display','block');
            });
        })
    </script>
    
<!--     <script>
var old_count = 0;
var i = 0;
setInterval(function(){    
$.ajax({
    type : "POST",
    url : "alertNewOrder.php",
    success : function(data){
        if (data > old_count) { if (i == 0){old_count = data;} 
            else{
            alert('New Enquiry!');
            old_count = data;}
        } i=1;
    }
});
},1000);
</script>--> 
  <script>

setInterval(function(){    
$.ajax({
    type : "POST",
    url : "alertNewOrder.php",
    success : function(data){
       $.each(data,function(i,field){
					$("#btnNewOrder span").html(field.ordercount);
				});
    }
});
},1000);
$(document).on("click","#btnNewOrder",function(){
	$.ajax({
    type : "POST",
    url : "api_updateOrdercount.php",
    success : function(data){
       $.each(data,function(i,field){
       				var status=field.status;
					if(status==1)
					{
						window.location.href="https://www.laundrybucket.co.in/lb-admin/allorder_list_new.php";
					}
					else
					{
						alert("error");
					}
				});
    }
});
});

setInterval(function(){    
$.ajax({
    type : "POST",
    url : "alertNewEnquiry.php",
    success : function(data){
       $.each(data,function(i,field){
					$("#btnNewEnquiry span").html(field.enquirycount);
				});
    }
});
},1000);
$(document).on("click","#btnNewEnquiry",function(){
	$.ajax({
    type : "POST",
    url : "api_updateEnquirycount.php",
    success : function(data){
       $.each(data,function(i,field){
       				var status=field.status;
					if(status==1)
					{
						window.location.href="https://laundrybucket.co.in/lb-admin/querycontact.php";
					}
					else
					{
						alert("error");
					}
				});
    }
});
});

$(document).on("click","#btnRemind",function(){
	var r=confirm("Do you want to send invoice to this customer");
	var oid=$(this).attr("title");
  		if(r==true)
  		{
  		 window.location.href="api_sendinvoice.php?oid="+oid;
  		}
  		else
  		{
  			return false;
  		}
});

$(document).on("click",".btnPrintTagdetail",function(){
	var oid=$(this).attr("title");
	$("#oid_print").val(oid);
});
</script>
      <script>
            $(document).ready(function () {
                $('input.tableflat').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });
            });

            var asInitVals = new Array();
            $(document).ready(function () {
                var oTable = $('#example').dataTable({
                    "oLanguage": {
                        "sSearch": "Search all columns:"
                    },
                    "aoColumnDefs": [
                        {
                            'bSortable': false,
                            'aTargets': [0]
                        } //disables sorting for column one
            ],
                    'iDisplayLength': 12,
                    "sPaginationType": "full_numbers",
                    "dom": 'T<"clear">lfrtip',
                    "tableTools": {
                        "sSwfPath": "<?php echo base_url('assets2/js/Datatables/tools/swf/copy_csv_xls_pdf.swf'); ?>"
                    }
                });
                $("tfoot input").keyup(function () {
                    /* Filter on the column based on the index of this element's parent <th> */
                    oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
                });
                $("tfoot input").each(function (i) {
                    asInitVals[i] = this.value;
                });
                $("tfoot input").focus(function () {
                    if (this.className == "search_init") {
                        this.className = "";
                        this.value = "";
                    }
                });
                $("tfoot input").blur(function (i) {
                    if (this.value == "") {
                        this.className = "search_init";
                        this.value = asInitVals[$("tfoot input").index(this)];
                    }
                });
            });
        </script>
        
    <!--
    <script type="text/javascript">
        var permanotice, tooltip, _alert;
        $(function () {
            new PNotify({
                title: "PNotify",
                type: "dark",
                text: "Welcome. Try hovering over me. You can click things behind me, because I'm non-blocking.",
                nonblock: {
                    nonblock: true
                },
                before_close: function (PNotify) {
                    // You can access the notice's options with this. It is read only.
                    //PNotify.options.text;

                    // You can change the notice's options after the timer like this:
                    PNotify.update({
                        title: PNotify.options.title + " - Enjoy your Stay",
                        before_close: null
                    });
                    PNotify.queueRemove();
                    return false;
                }
            });

        });
    </script>
    -->
    <script>
        $(document).ready(function () {
            $('.progress .bar').progressbar(); // bootstrap 2
            $('.progress .progress-bar').progressbar(); // bootstrap 3
        });
    </script>

</body>

</html>
<?php
mysql_close();
?>
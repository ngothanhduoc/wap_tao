<script type="text/javascript">
    setActiveMenu('userapp');
    setActiveSubMenu('backend-userapp-login-time');
    
</script>
<!--Chart---->
<script type="text/javascript" src="/admin/assets/highchart/js/highcharts.js"></script>
<script type="text/javascript" src="/admin/assets/highchart/js/modules/exporting.js"></script>
<!--End------>


<!----timeoicker----->
<link rel="stylesheet" href="/admin/assets/css/plugins/jquery-ui-timepicker-addon.css" type="text/css" />
<link rel="stylesheet" media="all" type="text/css" href="/admin/assets/css/plugins/jquery-ui.1.11.0.css" />
<script type="text/javascript" src="/admin/assets/js/plugins/jquery-ui.1.11.0.min.js"></script>
<script type="text/javascript" src="/admin/assets/js/plugins/jquery-ui-timepicker-addon.js"></script>
<!----End------------>
<script>
   $(document).ready(function() {
        var startDateTextBox = $('#datepicker_start');
        var endDateTextBox = $('#datepicker_end');

        startDateTextBox.datetimepicker({
            dateFormat: 'yy-mm-dd',
            timeFormat: 'HH:mm:ss',
            
            onClose: function(dateText, inst) {
                if (endDateTextBox.val() != '') {
                    var testStartDate = startDateTextBox.datetimepicker('getDate');
                    var testEndDate = endDateTextBox.datetimepicker('getDate');
                    if (testStartDate > testEndDate)
                        endDateTextBox.datetimepicker('setDate', testStartDate);
                }
                else {
                    endDateTextBox.val(dateText);
                }
            },
            
            onSelect: function(selectedDateTime) {
                endDateTextBox.datetimepicker('option', 'minDate', startDateTextBox.datetimepicker('getDate'));
            }
            
        });
        endDateTextBox.datetimepicker({
            dateFormat: 'yy-mm-dd',
            timeFormat: 'HH:mm:ss',
            
            onClose: function(dateText, inst) {
                if (startDateTextBox.val() != '') {
                    var testStartDate = startDateTextBox.datetimepicker('getDate');
                    var testEndDate = endDateTextBox.datetimepicker('getDate');
                    if (testStartDate > testEndDate)
                        startDateTextBox.datetimepicker('setDate', testEndDate);
                }
                else {
                    startDateTextBox.val(dateText);
                }
            },
            
            onSelect: function(selectedDateTime) {
                startDateTextBox.datetimepicker('option', 'maxDate', endDateTextBox.datetimepicker('getDate'));
            }
            
        });        
    });
</script>
<script type="text/javascript" src="/admin/assets/js/backend/backend.userapp.createtime.js?v=1"></script>
<div class="pageheader notab">
	<h1 class="pagetitle">Thống kê User Log-in</h1>
	<span class="pagedesc"></span>
	
</div><!--pageheader-->

<div id="contentwrapper" class="contentwrapper lineheight21" style="position: relative; z-index: 9">
    <div id="info-news" class="subcontent" style="display: block">
        <form class="stdform stdform2" id="frm-history-rotation" role="form" action="" method="POST" enctype="multipart/form-data">
            <p>
                <label>Thời gian <small>Chọn thời gian bắt đầu và kết thúc</small></label>
                <span class="field">
                    Từ <input id="datepicker_start" type="text" name="start_time" class="width100" value="<?php echo empty($data['start_time']) ? '' : date('m/d/Y H:i', strtotime($data['start_time'])) ?>" style="width: 150px !important"/>  
                    Đến <input id="datepicker_end" type="text" name="end_time" class="width100" value="<?php echo empty($data['end_time']) ? '' : date('m/d/Y H:i', strtotime($data['end_time'])) ?>" style="width: 150px !important"/> 
                </span>
            </p>
            
            <p class="stdformbutton">
                <input id="txt_id" type="hidden" value="" name="id">
                <button  class="submit radius2" type="submit">OK</button>
            </p>
        </form>
    </div>

</div>
<div class="contentwrapper lineheight21" style="position: relative; z-index: 1">
	<div id="container-chart"></div>				
</div><!--contentwrapper-->
<div class="contentwrapper lineheight21" style="position: relative; z-index: 1">
	<div id="jqxgrid"></div>				
</div><!--contentwrapper-->

<script>
    
</script>

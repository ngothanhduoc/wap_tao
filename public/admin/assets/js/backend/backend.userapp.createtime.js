$(document).ready(function() {
    //-- init element ----------------------------------------------------------
    BACKEND.commit();
    //BACKEND.initDropdownlistUser();   
});

var arrCat = [];
var BACKEND = {
    API_URL_LIST: '/backend/ajax/listhistory/user_app',
    AJAX_URL_CHART: '/backend/ajax/chart/user_app',
    API_URL_TOTAL: '/backend/ajax/totalhistory/user_app',
    OBJ_GRID: null,
    dataAdapter: function() {
        //-- init grid view --------------------------------------------------------
        var start_time = $('#datepicker_start').val();
        var end_time = $('#datepicker_end').val();
        var source = {
            datatype: "jsonp",
            datafields: [
                {name: 'id_user_app', type: 'int'},
                {name: 'user_name', type: 'string'},
                {name: 'icoin', type: 'int'},
		{name: 'platform', type: 'string'},
                {name: 'device_id', type: 'string'},
                {name: 'channel', type: 'string'},
                {name: 'create_time', type: 'string'},
                {name: 'login_time', type: 'string'}, 
            ],
            data: {start_time: start_time, end_time: end_time},
            url: BACKEND.API_URL_LIST,
            cache: false,
            sort: function() {
                BACKEND.OBJ_GRID.jqxGrid('updatebounddata', 'sort');
            },
            filter: function() {
                BACKEND.OBJ_GRID.jqxGrid('updatebounddata', 'filter');
            },
        };

        var dataAdapter = new $.jqx.dataAdapter(source, {
            beforeLoadComplete: function(records) {
                var p = dataAdapter.pagenum;
                var s = dataAdapter.pagesize;
                var j = p * s;

                for (var i = j; i < records.length; i++) {
                    records[i].idCoppy = records[i].id_user_app;                    
                }
                ;

                return records;
            }
        });

        return dataAdapter;
    },
    numcolumnrender: function(row, datafield, value) {
        var res = value.split(",");
        
        return '<div class="grid-tools"><input name="n_' + res[0] + '" id="n_' + res[0] + '" value="' + res[1] + '" onClick="this.setSelectionRange(0, this.value.length)" size="9"><a href="javascript:void(0)" onclick=BACKEND.setNum("n_' + res[0] + '",' + res[0] + ')>&nbsp;Set&nbsp;</a></div>';
    },
    sharecolumnrender: function(row, datafield, value) {
        var res = value.split(",");
        
        return '<div class="grid-tools"><input name="s_' + res[0] + '" id="s_' + res[0] + '" value="' + res[1] + '" onClick="this.setSelectionRange(0, this.value.length)" size="9"><a href="javascript:void(0)" onclick=BACKEND.setNumShare("s_' + res[0] + '",' + res[0] + ')>&nbsp;Set&nbsp;</a></div>';
    },
    sttcolumnrender: function(row, datafield, value) {
        var index = row + 1;
        return '<div style="overflow: hidden; text-overflow: ellipsis; padding-bottom: 2px; text-align: left; margin:4px 2px 0px 4px;">' + index + '</div>';
    },
    toolscolumnrender: function(row, datafield, value) {
        return '<div class="grid-tools"><a href="#" onclick="BACKEND.gridEdit(' + value + ');return false;" class="grid-tools"><span class="ui-icon ui-icon-pencil"></span></a><!--<a href="#" onclick="BACKEND.gridDelete(' + value + ');return false;"><span class="ui-icon ui-icon-trash"></span></a>--></div>';
    },
    statuscolumnrender: function(row, datafield, value) {
        var res = value.split(",");
        var str = '<a href="javascript:void(0)" onclick="BACKEND.desable(' + res[0] + ');"><span class="data-status enable" title="Đã kích hoạt">&nbsp;</span></a>';
        if (res[1] == 'block') {
            str = '<a href="javascript:void(0)" onclick="BACKEND.enable(' + res[0] + ');"><span class="data-status disable" title="Chưa kích hoạt">&nbsp;</span></a>';
        }
        return str;
    },
    init: function() {
        //var form = new FormData($('#frm-history-rotation')[0]);
        BACKEND.OBJ_GRID = $("#jqxgrid");
        var dataAdapter = BACKEND.dataAdapter();
        BACKEND.OBJ_GRID.jqxGrid({
            width: '100%',
            source: dataAdapter,
            columnsresize: true,
            sortable: true,
            theme: 'office',
            columns: [
                {text: 'STT', cellsrenderer: BACKEND.sttcolumnrender, width: 40, filterable: false},
                {text: 'ID', datafield: 'id_user_app', width: 50},
		{text: 'USER NAME', datafield: 'user_name'},
                {text: 'ICOIN', datafield: 'icoin'},
		{text: 'PLATFORM', datafield: 'platform'},
                //{text: 'DEVICE ID', datafield: 'device_id'},
                {text: 'CHANNEL', datafield: 'channel'},
                {text: 'CREATE TIME', datafield: 'create_time'},
                {text: 'LOGIN TIME', datafield: 'login_time'},                
            ],
            virtualmode: true,
            rendergridrows: function() {
                return dataAdapter.records;
            },
            pageable: true,
            pagesize: 20,
            pagesizeoptions: ['20', '50', '100'],
            //--> Filter ---------------------------------------------------
            showfilterrow: true,
            filterable: true,
            localization: CUSTOMLANGUAGEVN
        });
    },
    resetGrid: function() {
        BACKEND.OBJ_GRID.jqxGrid('updatebounddata');
    },
    gridDelete: function(id) {
        if (confirm('Bạn có chắc muốn xóa ?')) {
            $.ajax({
                url: BACKEND.AJAX_URL_DELETE + '?id=' + id,
                type: 'GET',
                dataType: 'JSON',
                data: {}
            }).done(function(response) {
                console.log(response);
                if (response.code != 0) {
                    alert(response.message);
                } else {
                    BACKEND.resetGrid();
                }
            }).fail(function() {
                alert('Có lỗi ! Không kết nối đến dữ liệu được.');
            });
        }
    },
    gridEdit: function(id) {
        //loadPopup(id, false);
        window.location.href = '/backend/game/add?id=' + id;
    },
   
    desable: function(id) {
        $.ajax({
            url: BACKEND.AJAX_URL_UPDATE + '?id=' + id + '&st=block&field=status',
            type: 'GET',
            dataType: 'JSON',
            data: {}
        }).done(function(response) {
            console.log(response);
            if (response.code != 0) {
                alert(response.message);
            } else {
                BACKEND.resetGrid();
            }
        }).fail(function() {
            alert('Có lỗi ! Không kết nối đến dữ liệu được.');
        });
    },
    enable: function(id) {
        $.ajax({
            url: BACKEND.AJAX_URL_UPDATE + '?id=' + id + '&st=active&field=status',
            type: 'GET',
            dataType: 'JSON',
            data: {}
        }).done(function(response) {
            console.log(response);
            if (response.code != 0) {
                alert(response.message);
            } else {
               BACKEND.resetGrid();
            }
        }).fail(function() {
            alert('Có lỗi ! Không kết nối đến dữ liệu được.');
        });
    },
   setNum: function(obj, id) {
        var s = $("#" + obj).val();
        $.ajax({
            url: BACKEND.AJAX_URL_UPDATE + '?id=' + id + '&st=' + s + '&field=icoin_download',
            type: 'GET',
            dataType: 'JSON',
            data: {}
        }).done(function(response) {
            console.log(response);
            if (response.code != 0) {
                alert(response.message);
            } else {
                BACKEND.resetGrid();
            }
        }).fail(function() {
            alert('Có lỗi ! Không kết nối đến dữ liệu được.');
        });
    },
    setNumShare: function(obj, id) {
        var s = $("#" + obj).val();
        $.ajax({
            url: BACKEND.AJAX_URL_UPDATE + '?id=' + id + '&st=' + s + '&field=icoin_share',
            type: 'GET',
            dataType: 'JSON',
            data: {}
        }).done(function(response) {
            console.log(response);
            if (response.code != 0) {
                alert(response.message);
            } else {
                BACKEND.resetGrid();
            }
        }).fail(function() {
            alert('Có lỗi ! Không kết nối đến dữ liệu được.');
        });
    },
    getTotal: function(){
        if($('#jqxDropdownlistUser').val() != ''){
            //var id_user_app = arrUserId[$('#jqxDropdownlistUser').val()];
            var id_user_app = $('#jqxDropdownlistUser').val();
        }else{
            var id_user_app = 0;
        }
        var start_time = $('#datepicker_start').val();
        var end_time = $('#datepicker_end').val();
        $.ajax({
            url: BACKEND.API_URL_TOTAL,
            type: 'GET',
            dataType: 'JSON',
            data: {start_time: start_time, end_time: end_time}
        }).done(function(response) {
            console.log(response);
            $('#total-plat').html(response);
        }).fail(function() {
            alert('Có lỗi ! Không kết nối đến dữ liệu được.');
        });
    },
    commit: function() {
        $('#frm-history-rotation').submit(function(e) {
            e.preventDefault();
            //$('button:submit').attr("disabled", true);
            var form = new FormData($('#frm-history-rotation')[0]);
            //console.log(form);
           
            
            $.ajax({
                url: BACKEND.AJAX_URL_CHART,
                type: "POST",
                processData: false, // Don't process the files
                contentType: false,
                data: form,
                //beforeSend: BACKEND.startLoading,
                //complete: BACKEND.topLoading,
                dataType: "JSON",
                success: BACKEND.callbackChart                
            });
            BACKEND.getTotal();
            BACKEND.init();

        });





    },
    callbackChart: function(response){
        var android = parseInt(response.android);
        var ios = parseInt(response.ios);
        var wp = parseInt(response.wp);
        $('#container-chart').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'BIỂU ĐỒ DEVICE THEO PLATFORM'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },       
            series: [{
                    type: 'pie',
                    name: 'Browser share',
                    data: [
                            ['Android', android],
                            ['Ios',ios],
                            ['WindowPhone', wp]
                    ]
                }],

        });
    },
    initDropdownlistUser: function(data) {
        var source = arrUser;
        $("#jqxDropdownlistUser").jqxDropDownList({filterable: true, filterPlaceHolder: ' Tìm kiếm', searchMode: 'containsignorecase', source: source, width: '50%', height: '25', theme: 'office', placeHolder: "Vui lòng chọn"});

        if (data != '') {
            data = data.replace(/`/g, "'");
            $("#jqxDropdownlistUser").jqxDropDownList('selectItem', data);
        }

    }, 
}
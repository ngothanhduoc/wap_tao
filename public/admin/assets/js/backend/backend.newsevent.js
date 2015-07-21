$(document).ready(function() {
    //-- init element ----------------------------------------------------------
    //BACKEND.loadCat();
    //$.getScript('/admin/assets/libraries/jsdatetimepicker/jquery.datetimepicker.js', function() {
    //});
    //$('head').append('<link rel="stylesheet" href="/admin/assets/libraries/jsdatetimepicker/jquery.datetimepicker.css" type="text/css" />');
    BACKEND.init();
});

var arrCat = [];
var BACKEND = {
    API_URL_LIST: '/backend/listnewsevent',
    AJAX_URL_DELETE: '/backend/deletenews/news',
    AJAX_URL_UPDATE: '/backend/ajax/updatestatusgame/admin_newsevent/index/news/id_news',
    OBJ_GRID: null,
    dataAdapter: function() {
        //-- init grid view --------------------------------------------------------
        var source = {
            datatype: "jsonp",
            datafields: [
                {name: 'id_news', type: 'int'},
                {name: 'title', type: 'string'},
                {name: 'id_game', type: 'string'},
                {name: 'create_time', type: 'string'},
                {name: 'status', type: 'string'},
                {name: 'hot', type: 'string'},
                {name: 'user_create', type: 'string'},
            ],
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
                    records[i].idCoppy = records[i].id_news;
                    records[i].game = arrGame[records[i].id_game];
                    records[i].idStatus = records[i].id_news + ',' + records[i].status;
                    records[i].idHot = records[i].id_news + ',' + records[i].hot;                   
                }
                ;

                return records;
            }
        });

        return dataAdapter;
    },
    sttcolumnrender: function(row, datafield, value) {
        var index = row + 1;
        return '<div style="overflow: hidden; text-overflow: ellipsis; padding-bottom: 2px; text-align: left; margin:4px 2px 0px 4px;">' + index + '</div>';
    },
    toolscolumnrender: function(row, datafield, value) {
        return '<div class="grid-tools"><a href="javascript:void(0)" onclick="BACKEND.gridEdit(' + value + ');return false;" class="grid-tools" title="Sửa"><span class="ui-icon ui-icon-pencil"></span></a><!--<a href="javascript:void(0)" onclick="BACKEND.gridDelete(' + value + ');return false;"><span class="ui-icon ui-icon-trash"></span></a>--></div>';
    },
    statuscolumnrender: function(row, datafield, value) {
        var res = value.split(",");
        var str = '<a href="javascript:void(0)" onclick="BACKEND.desable(' + res[0] + ');"><span class="data-status enable" title="Đã kích hoạt">&nbsp;</span></a>';
        if (res[1] == 'not') {
            str = '<a href="javascript:void(0)" onclick="BACKEND.enable(' + res[0] + ');"><span class="data-status disable" title="Chưa kích hoạt">&nbsp;</span></a>';
        }
        return str;
    },
    hotcolumnrender: function(row, datafield, value) {
        var res = value.split(",");
        var str = '<a href="javascript:void(0)" onclick="BACKEND.unHot(' + res[0] + ');"><span class="data-status enable" title="Hot">&nbsp;</span></a>';
        if (res[1] == 'false') {
            str = '<a href="javascript:void(0)" onclick="BACKEND.setHot(' + res[0] + ');"><span class="data-status disable" title="">&nbsp;</span></a>';
        }
        return str;
    },    
    init: function() {
        BACKEND.OBJ_GRID = $("#jqxgrid");
        var dataAdapter = BACKEND.dataAdapter();
        BACKEND.OBJ_GRID.jqxGrid({
            width: '100%',
            height: '600px',
            source: dataAdapter,
            columnsresize: true,
            sortable: true,
            //theme: 'energyblue',
            theme: 'office',
            //theme: 'summer',
            columns: [
                {text: 'STT', cellsrenderer: BACKEND.sttcolumnrender, width: 40, filterable: false},
                {text: 'TIÊU ĐỀ', datafield: 'title'},
                {text: 'GAME ID', datafield: 'id_game', width: 100},
                {text: 'GAME', datafield: 'game', filterable: false, sortable: false},
                {text: 'NGÀY TẠO', datafield: 'create_time', filterable: false, sortable: false, width: 150},
                {text: 'NGƯỜI TẠO', datafield: 'user_create', width: 100},
                {text: 'HOT', datafield: 'idHot', cellsrenderer: BACKEND.hotcolumnrender, width: 50, filterable: false, sortable: false},
                {text: 'STATUS', datafield: 'idStatus', cellsrenderer: BACKEND.statuscolumnrender, width: 50, filterable: false, sortable: false},
                {text: 'CÔNG CỤ', datafield: 'id_news', cellsalign: 'center', align: 'center', cellsrenderer: BACKEND.toolscolumnrender, width: 60, sortable: false, filterable: false},
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
        window.location.href = '/backend/newsevent/add/' + id;
    },   
    desable: function(id) {
        if ($('#userdata').val() == 2) {
            $.ajax({
                url: BACKEND.AJAX_URL_UPDATE + '?id=' + id + '&st=not&field=status',
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
    enable: function(id) {
        if ($('#userdata').val() == 2) {
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
                    $.ajax({
                        url: BACKEND.AJAX_URL_UPDATE_SITEMAP + '?id=' + id,
                        success: function() {
                            if (response.code != 0) {
                                alert(response.message);
                            } else {

                            }
                        }
                    });
                    BACKEND.resetGrid();
                }
            }).fail(function() {
                alert('Có lỗi ! Không kết nối đến dữ liệu được.');
            });
        }
    },
    unHot: function(id) {
        if ($('#userdata').val() == 2) {
            $.ajax({
                url: BACKEND.AJAX_URL_UPDATE + '?id=' + id + '&st=false&field=hot',
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
    setHot: function(id) {
        if ($('#userdata').val() == 2) {
            $.ajax({
                url: BACKEND.AJAX_URL_UPDATE + '?id=' + id + '&st=true&field=hot',
                type: 'GET',
                dataType: 'JSON',
                data: {}
            }).done(function(response) {
                console.log(response);
                if (response.code != 0) {
                    alert(response.message);
                } else {
                    $.ajax({
                        url: BACKEND.AJAX_URL_UPDATE_SITEMAP + '?id=' + id,
                        success: function() {
                            if (response.code != 0) {
                                alert(response.message);
                            } else {

                            }
                        }
                    });
                    BACKEND.resetGrid();
                }
            }).fail(function() {
                alert('Có lỗi ! Không kết nối đến dữ liệu được.');
            });
        }
    },
    
    dridirect: function(url){
        window.open(url,'_blank');
    }
}
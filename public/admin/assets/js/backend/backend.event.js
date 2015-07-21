$(document).ready(function() {
    //-- init element ----------------------------------------------------------
    $.getScript('/admin/assets/libraries/jsdatetimepicker/jquery.datetimepicker.js', function() {
    });
    $('head').append('<link rel="stylesheet" href="/admin/assets/libraries/jsdatetimepicker/jquery.datetimepicker.css" type="text/css" />');
    BACKEND.init();
});


var BACKEND = {
    API_URL_LIST: '/backend/list/events',
    AJAX_URL_DELETE: '/backend/ajax/delete/admin_event/index/events/id',
    AJAX_URL_UPDATE: '/backend/ajax/updatestatus/admin_event/index/events/id',
    OBJ_GRID: null,
    dataAdapter: function() {
        //-- init grid view --------------------------------------------------------
        var source = {
            datatype: "jsonp",
            datafields: [
                {name: 'id', type: 'int'},
                {name: 'name', type: 'string'},
                {name: 'timer', type: 'string'},
                {name: 'create_time', type: 'string'},
                {name: 'create_by', type: 'string'},
                {name: 'status', type: 'int'}

            ],
            url: BACKEND.API_URL_LIST,
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
                    //records[i].idCoppy = records[i].id;
                    records[i].idstatus = records[i].id + ',' + records[i].status;
                    records[i].timer = records[i].id + ',' + records[i].timer;
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
        return '<div class="grid-tools"><a href="javascript:void(0)" onclick="BACKEND.gridEdit(' + value + ');return false;" class="grid-tools"><span class="ui-icon ui-icon-pencil"></span></a><!--<a href="#" onclick="BACKEND.gridDelete(' + value + ');return false;"><span class="ui-icon ui-icon-trash"></span></a>--></div>';
    },
    rankingcolumnrender: function(row, datafield, value) {
        var res = value.split(",");
        var str = '<a href="javascript:void(0)" onclick="BACKEND.setBc(' + res[0] + ');"><span class="block-span member">Set Doanh thu cao</span></a>';
        if (res[1] == 1) {
            str = '<a href="javascript:void(0)" onclick="BACKEND.unsetBc(' + res[0] + ');"><span class="block-span admin">Doanh thu cao</span></a>';
        }
        return str;
    },
    sortcolumnrender: function(row, datafield, value) {
        var res = value.split(",");
        return '<div class="grid-tools"><input name="n_' + res[0] + '" id="n_' + res[0] + '" value="' + res[1] + '" size="5"><a href="javascript:void(0)" onclick=BACKEND.setSort("n_' + res[0] + '",' + res[0] + ')>&nbsp;Set&nbsp;</a></div>';
    },
    sharemorecolumnrender: function(row, datafield, value) {
        var res = value.split(",");
        var str = '<a href="javascript:void(0)" onclick="BACKEND.setShare(' + res[0] + ');"><span class="block-span member">Set Chia sẻ cao</span></a>';
        if (res[1] == 1) {
            str = '<a href="javascript:void(0)" onclick="BACKEND.unsetShare(' + res[0] + ');"><span class="block-span admin">Chia sẻ cao</span></a>';
        }
        return str;
    },
    settimer: function(row, datafield, value) {
        var res = value.split(",");
        return '<div class="grid-tools"><input onclick=BACKEND.datetimepicker("d_' + res[0] + '") name="d_' + res[0] + '" id="d_' + res[0] + '" value="' + res[1] + '" size="15"><a href="javascript:void(0)" onclick=BACKEND.setDateTime("d_' + res[0] + '",' + res[0] + ')>&nbsp;Set&nbsp;</a></div>';
    },
    statuscolumnrender: function(row, datafield, value) {
        var res = value.split(",");
        var str = '<a href="javascript:void(0)" onclick="BACKEND.desable(' + res[0] + ');"><span class="data-status enable" title="Đã kích hoạt">&nbsp;</span></a>';
        if (res[1] == 0) {
            str = '<a href="javascript:void(0)" onclick="BACKEND.enable(' + res[0] + ');"><span class="data-status disable" title="Chưa kích hoạt">&nbsp;</span></a>';
        }
        return str;
    },
    imgcolumnrender: function(row, datafield, value) {
        var res = value.split(",");
        return '<div class="grid-tools"><input onclick=openKCFinderByPath("#i_' + res[0] + '","image") name="i_' + res[0] + '" id="i_' + res[0] + '" value="' + res[1] + '" style="width:200px"><a href="javascript:void(0)" onclick=BACKEND.setImage("i_' + res[0] + '",' + res[0] + ')>&nbsp;Set&nbsp;</a></div>';
    },
    imgwapcolumnrender: function(row, datafield, value) {
        var res = value.split(",");
        return '<div class="grid-tools"><input onclick=openKCFinderByPath("#w_' + res[0] + '","image") name="w_' + res[0] + '" id="w_' + res[0] + '" value="' + res[1] + '" style="width:200px"><a href="javascript:void(0)" onclick=BACKEND.setImageWap("w_' + res[0] + '",' + res[0] + ')>&nbsp;Set&nbsp;</a></div>';
    },
    urlcolumnrender: function(row, datafield, value) {
        var res = value.split(",");
        return '<div class="grid-tools"><input name="d_' + res[0] + '" id="d_' + res[0] + '" value="' + res[1] + '" style="width:200px"><a href="javascript:void(0)" onclick=BACKEND.setUrl("d_' + res[0] + '",' + res[0] + ')>&nbsp;Set&nbsp;</a></div>';
    },
    isgetinfousercolumnrender: function(row, datafield, value) {
        var str = null;
        if (value == 0) {
            str = '<center>Không</center>';
        } else {
            str = '<center>Có</center>'
        }
        return str;
    },
    stylevotecolumnrender: function(row, datafield, value) {
        var str = null;
        if (value == 0) {
            str = '<center>Chỉ chọn 1 tiêu chí</center>';
        } else {
            str = '<center>Chọn nhiều tiêu chí</center>'
        }
        return str;
    },
    iconcolumnrender: function(row, datafield, value) {
        var img = '<img src="/uploads/image/fix/' + value + '" width="20" />';
        return '<div style="text-align:center; overflow: hidden; text-overflow: ellipsis; padding-bottom: 2px; margin:4px 2px 0px 4px;">' + img + '</div>';
    },
    init: function() {
        BACKEND.OBJ_GRID = $("#jqxgrid");
        var dataAdapter = BACKEND.dataAdapter();
        BACKEND.OBJ_GRID.jqxGrid({
            width: '100%',
            source: dataAdapter,
            columnsresize: true,
            sortable: true,
            //theme: 'energyblue',
            theme: 'office',
            //theme: 'summer',
            columns: [
                {text: 'STT', cellsrenderer: BACKEND.sttcolumnrender, width: 40, filterable: false},
                {text: 'TÊN EVENT', datafield: 'name'},
                {text: 'THỜI GIAN TẠO', datafield: 'create_time', filterable: false, sortable: false, width: 80},
                {text: 'TIMER', datafield: 'timer', filterable: false, sortable: false, width: 200, cellsrenderer: BACKEND.settimer},
                //{text: 'ID_YOUTUBE', datafield: 'url', filterable: false, sortable: false, width: 270, cellsrenderer: BACKEND.urlcolumnrender},
                {text: 'TRẠNG THÁI', datafield: 'idstatus', cellsalign: 'center', align: 'center', cellsrenderer: BACKEND.statuscolumnrender, width: 80, sortable: false, filterable: false},
                {text: 'CÔNG CỤ', datafield: 'id', cellsalign: 'center', align: 'center', cellsrenderer: BACKEND.toolscolumnrender, width: 80, sortable: false, filterable: false},
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
        window.location.href = '/backend/event/add?id=' + id;
    },
    setBc: function(id) {
        $.ajax({
            url: BACKEND.API_URL_BC + '?id=' + id + '&st=1&field=sellmore',
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
    unsetBc: function(id) {
        $.ajax({
            url: BACKEND.API_URL_BC + '?id=' + id + '&st=0&field=sellmore',
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
    setShare: function(id) {
        $.ajax({
            url: BACKEND.API_URL_BC + '?id=' + id + '&st=1&field=sharemore',
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
    unsetShare: function(id) {
        $.ajax({
            url: BACKEND.API_URL_BC + '?id=' + id + '&st=0&field=sharemore',
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
    setSort: function(obj, id) {
        var s = $("#" + obj).val();
        $.ajax({
            url: BACKEND.API_URL_SORT + '?id=' + id + '&st=' + s,
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
    desable: function(id) {
        $.ajax({
            url: BACKEND.AJAX_URL_UPDATE + '?id=' + id + '&st=0&field=status',
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
            url: BACKEND.AJAX_URL_UPDATE + '?id=' + id + '&st=1&field=status',
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
    setDateTime: function(obj, id) {
        var s = $("#" + obj).val();
        $.ajax({
            url: BACKEND.AJAX_URL_UPDATE + '?id=' + id + '&st=' + s + '&field=timer',
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
    datetimepicker: function(obj) {
        $("#" + obj).datetimepicker({format: 'Y-m-d H:i:s'});
    },
    setImage: function(obj, id) {
        var s = $("#" + obj).val();

        $.ajax({
            url: BACKEND.AJAX_URL_UPDATE + '?id=' + id + '&st=' + s + '&field=image',
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
    setImageWap: function(obj, id) {
        var s = $("#" + obj).val();

        $.ajax({
            url: BACKEND.AJAX_URL_UPDATE + '?id=' + id + '&st=' + s + '&field=wap_image',
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
}
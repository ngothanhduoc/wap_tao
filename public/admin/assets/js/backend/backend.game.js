$(document).ready(function() {
    //-- init element ----------------------------------------------------------
    //BACKEND.loadCat();
    BACKEND.init();
});

var arrCat = [];
var BACKEND = {
    API_URL_LIST: '/backend/listgame',
    AJAX_URL_UPDATE: '/backend/ajax/updatestatusgame/admin_game/index/game_app/id_game_app',
    AJAX_URL_DELETE: '/backend/ajax/deletegame/admin_game/index/game/id_game',
    API_URL_BC: '/inside/ajax/updatebc/game',
    API_URL_CAT: '/inside/ajax/get_list_cat/game_category',
    API_URL_SORT: '/inside/ajax/updatesort/game',
    OBJ_GRID: null,
    dataAdapter: function() {
        //-- init grid view --------------------------------------------------------
        var source = {
            datatype: "jsonp",
            datafields: [
                {name: 'id_game_app', type: 'int'},
                {name: 'name', type: 'string'},
                {name: 'platform', type: 'string'},
                {name: 'type', type: 'string'},
                {name: 'code_game', type: 'string'},                
                {name: 'status', type: 'string'},
                {name: 'create_user', type: 'string'},
                {name: 'count_download', type: 'int'}, 
                {name: 'count_install', type: 'int'}, 
                {name: 'set_new', type: 'string'},
                {name: 'favorite', type: 'string'},
                {name: 'order', type: 'int'},
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
                    records[i].idCoppy = records[i].id_game_app;
                    records[i].idStatus = records[i].id_game_app + ',' + records[i].status;
                    records[i].idDown = records[i].id_game_app + ',' + records[i].count_download;
                    records[i].idInstall = records[i].id_game_app + ',' + records[i].count_install;
                    records[i].idSlide = records[i].id_game_app + ',' + records[i].set_new;
                    records[i].idFavorite = records[i].id_game_app + ',' + records[i].favorite;
                    records[i].idOrder = records[i].id_game_app + ',' + records[i].order;
                    
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
    slidecolumnrender: function(row, datafield, value) {
        var res = value.split(",");
        var str = '<a href="javascript:void(0)" onclick="BACKEND.unslide(' + res[0] + ');"><span class="data-status enable" title="Đã set slide">&nbsp;</span></a>';
        if (res[1] == 'block') {
            str = '<a href="javascript:void(0)" onclick="BACKEND.slide(' + res[0] + ');"><span class="data-status disable" title="Chưa set slide">&nbsp;</span></a>';
        }
        return str;
    },
    favcolumnrender: function(row, datafield, value) {
        var res = value.split(",");
        var str = '<a href="javascript:void(0)" onclick="BACKEND.favunset(' + res[0] + ');"><span class="data-status enable" title="Đã set slide">&nbsp;</span></a>';
        if (res[1] == 'block') {
            str = '<a href="javascript:void(0)" onclick="BACKEND.fav(' + res[0] + ');"><span class="data-status disable" title="Chưa set slide">&nbsp;</span></a>';
        }
        return str;
    },
    ordercolumnrender: function(row, datafield, value) {
        var res = value.split(",");
        
        return '<div class="grid-tools"><input name="o_' + res[0] + '" id="o_' + res[0] + '" value="' + res[1] + '" onClick="this.setSelectionRange(0, this.value.length)" size="3"><a href="javascript:void(0)" onclick=BACKEND.setNumOrder("o_' + res[0] + '",' + res[0] + ')>&nbsp;Set&nbsp;</a></div>';
    },           
    init: function() {
        BACKEND.OBJ_GRID = $("#jqxgrid");
        var dataAdapter = BACKEND.dataAdapter();
        BACKEND.OBJ_GRID.jqxGrid({
            width: '100%',
            source: dataAdapter,
            columnsresize: true,
            sortable: true,
            theme: 'office',
            columns: [
                {text: 'Stt', cellsrenderer: BACKEND.sttcolumnrender, width: 40, filterable: false},
                {text: 'NAME', datafield: 'name'},
                {text: 'PLATFORM', datafield: 'platform'},
                {text: 'TYPE', datafield: 'type'},
                {text: 'SET DOWNLOAD', cellsrenderer: BACKEND.sharecolumnrender, datafield: 'idDown', filterable: false, sortable: false, width: 150},
                {text: 'COUNT DOWNLOAD', datafield: 'count_install', width: 120},
                {text: 'SET GAME MỚI', datafield: 'idSlide', cellsrenderer: BACKEND.slidecolumnrender, width: 70, filterable: false, sortable: false},
                {text: 'SET YÊU THÍCH', datafield: 'idFavorite', cellsrenderer: BACKEND.favcolumnrender, width: 70, filterable: false, sortable: false},
                {text: 'ORDER', cellsrenderer: BACKEND.ordercolumnrender, datafield: 'idOrder', width: 100, filterable: false, sortable: false},
                {text: 'STATUS', datafield: 'idStatus', cellsrenderer: BACKEND.statuscolumnrender, width: 50, filterable: false, sortable: false},
                {text: 'Công cụ', datafield: 'id_game_app', cellsalign: 'center', align: 'center', cellsrenderer: BACKEND.toolscolumnrender, width: 80, sortable: false, filterable: false},
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
    unslide: function(id) {
        $.ajax({
            url: BACKEND.AJAX_URL_UPDATE + '?id=' + id + '&st=block&field=set_new',
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
    favunset: function(id) {
        $.ajax({
            url: BACKEND.AJAX_URL_UPDATE + '?id=' + id + '&st=block&field=favorite',
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
    slide: function(id) {
        $.ajax({
            url: BACKEND.AJAX_URL_UPDATE + '?id=' + id + '&st=active&field=set_new',
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
    fav: function(id) {
        $.ajax({
            url: BACKEND.AJAX_URL_UPDATE + '?id=' + id + '&st=active&field=favorite',
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
            url: BACKEND.AJAX_URL_UPDATE + '?id=' + id + '&st=' + s + '&field=count_install',
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
            url: BACKEND.AJAX_URL_UPDATE + '?id=' + id + '&st=' + s + '&field=count_download',
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
    setNumOrder: function(obj, id) {
        var s = $("#" + obj).val();
        $.ajax({
            url: BACKEND.AJAX_URL_UPDATE + '?id=' + id + '&st=' + s + '&field=order',
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
}
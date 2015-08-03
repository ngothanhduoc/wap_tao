$(document).ready(function() {
    //-- init element ----------------------------------------------------------
    //BACKEND.loadCat();
    BACKEND.init();
});

var arrCat = [];
var BACKEND = {
    API_URL_LIST: '/backend/list/cate',
    AJAX_URL_UPDATE: '/backend/ajax/updatestatusgame/category/list_category/cate/id_cate',
    OBJ_GRID: null,
    dataAdapter: function() {
        //-- init grid view --------------------------------------------------------
        var source = {
            datatype: "jsonp",
            datafields: [
                {name: 'id_cate', type: 'int'},
                {name: 'title', type: 'int'},
		{name: 'type', type: 'string'},
		{name: 'order', type: 'int'},
                {name: 'create_time', type: 'string'},                
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
            beforeLoadComplete: function (records) {
		var p = dataAdapter.pagenum;
		var s = dataAdapter.pagesize;
		var j = p*s;
				
		for (var i = j; i < records.length; i++) {
                    records[i].idCopy = records[i].id_cate;	
                    records[i].idOrder = records[i].id_cate + ',' + records[i].order;
                };
				
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
        return '<div class="grid-tools"><a href="javascript:void(0)" onclick="BACKEND.gridEdit(' + value + ');return false;" class="grid-tools"><span class="ui-icon ui-icon-pencil"></span></a><!--<a href="javascript:void(0)" onclick="BACKEND.gridDelete(' + value + ');return false;"><span class="ui-icon ui-icon-trash"></span></a>--></div>';
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
            //theme: 'energyblue',
            theme: 'office',
            //theme: 'summer',
            columns: [
                {text: 'STT', cellsrenderer: BACKEND.sttcolumnrender, width: 40, filterable: false},
//                {text: 'ID', datafield: 'idCopy', width: 50},
		{text: 'Name', datafield: 'title'},
		{text: 'TYPE', datafield: 'type'},
		{text: 'ORDER', cellsrenderer: BACKEND.ordercolumnrender, datafield: 'idOrder', width: 100, filterable: false, sortable: false},
                {text: 'CREATE TIME', datafield: 'create_time',width: 130,},
                {text: 'CÔNG CỤ', datafield: 'id_cate', cellsalign: 'center', align: 'center', cellsrenderer: BACKEND.toolscolumnrender, width: 80, sortable: false, filterable: false},
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
    gridEdit: function(id) {
        window.location.href = '/backend/category/add_list_category/' + id;
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

$(document).ready(function() {
    //-- init element ----------------------------------------------------------
    //BACKEND.loadCat();
    BACKEND.init();
});

var arrCat = [];
var BACKEND = {
    API_URL_LIST: '/backend/list/list_items',
    OBJ_GRID: null,
    dataAdapter: function() {
        //-- init grid view --------------------------------------------------------
        var source = {
            datatype: "jsonp",
            datafields: [
                {name: 'id', type: 'int'},
                {name: 'value', type: 'int'},
                {name: 'icoin', type: 'int'},
		{name: 'type', type: 'string'},
                {name: 'create_user', type: 'string'},
                {name: 'create_time', type: 'string'},
                {name: 'update_time', type: 'string'},
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
                    records[i].idCopy = records[i].id;				
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
                {text: 'ID', datafield: 'idCopy', width: 50},
		{text: 'VALUE', datafield: 'value'},
                {text: 'ICOIN', datafield: 'icoin'},
		{text: 'TYPE', datafield: 'type'},
                {text: 'CREATE USER', datafield: 'create_user'},
                {text: 'CREATE TIME', datafield: 'create_time'},
                {text: 'UPDATE TIME', datafield: 'update_time'},
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
    gridEdit: function(id) {
        window.location.href = '/backend/listitems/add/' + id;
    },
}
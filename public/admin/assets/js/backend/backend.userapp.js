$(document).ready(function() {
    //-- init element ----------------------------------------------------------
    //BACKEND.loadCat();
    BACKEND.init();
});

var arrCat = [];
var BACKEND = {
    API_URL_LIST: '/backend/list/user_app',
    OBJ_GRID: null,
    dataAdapter: function() {
        //-- init grid view --------------------------------------------------------
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
                    records[i].idCopy = records[i].id_user_app;				
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
                {text: 'ID', datafield: 'id_user_app', width: 50},
		{text: 'USER NAME', datafield: 'user_name'},
                {text: 'ICOIN', datafield: 'icoin'},
		{text: 'PLATFORM', datafield: 'platform'},
                {text: 'DEVICE ID', datafield: 'device_id'},
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
    }   
}
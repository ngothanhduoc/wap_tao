$(document).ready(function() {
    //-- init element ----------------------------------------------------------
    BACKEND.commit();
    BACKEND.initDropdownlistUser();   
});

var arrCat = [];
var BACKEND = {
    API_URL_LIST: '/backend/ajax/listhistory/history_gift_login',
    OBJ_GRID: null,
    dataAdapter: function() {
        //-- init grid view --------------------------------------------------------
        if($('#jqxDropdownlistUser').val() != ''){
            //var id_user_app = arrUserId[$('#jqxDropdownlistUser').val()];
            var id_user_app = $('#jqxDropdownlistUser').val();
        }else{
            var id_user_app = 0;
        }
        var start_time = $('#datepicker_start').val();
        var end_time = $('#datepicker_end').val();
        var source = {
            datatype: "jsonp",
            datafields: [
                {name: 'id_history_gift', type: 'int'},
                {name: 'user_name', type: 'string'},
                {name: 'user_name_recive', type: 'string'},
                {name: 'status_username', type: 'string'},
                {name: 'status_username_recive', type: 'string'},
                {name: 'create_time', type: 'string'},                
            ],
            data: {id_user_app: id_user_app, start_time: start_time, end_time: end_time},
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
                    records[i].idCoppy = records[i].id_history_gift;                    
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
                {text: 'USER NAME RECIVE', datafield: 'user_name_recive'},
                {text: 'STATUS USERNAME', datafield: 'status_username'},
                {text: 'STATUS USERNAME RECIVE', datafield: 'status_username_recive'},
                {text: 'CREATE TIME', datafield: 'create_time'},                
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
    commit: function() {
        $('#frm-history-rotation').submit(function(e) {
            e.preventDefault();
            //$('button:submit').attr("disabled", true);
            var form = new FormData($('#frm-history-rotation')[0]);
            //console.log(form);
            BACKEND.init();
            /*
            $.ajax({
                url: BACKEND.AJAX_URL_COMMIT,
                type: "POST",
                processData: false, // Don't process the files
                contentType: false,
                data: form,
                beforeSend: BACKEND.startLoading,
                complete: BACKEND.topLoading,
                dataType: "JSON"
            }).done(function(data) {

                if (data.code == 0) {
                    var m = data.message;
                    window.location.href = data.redirect;
                } else {
                    $('#platform').html('');
                    $('#type').html('');
                    $('#name-error').html('');
                    var m = data.message;


                    if (m.description != "") {
                        $('#description').val('');
                        $('#description').attr('placeholder', m.description);
                        var c = $("#description").position().top;
                        $('body,html').animate({scrollTop: c}, 800);
                    }
                    if (m.platform != "") {
                        $('#platform').html(m.platform);
                        var c = $("#platform").position().top;
                        $('body,html').animate({scrollTop: c}, 800);
                    }
                    if (m.type != "") {
                        $('#type').html(m.type);
                        var c = $("#type").position().top;
                        $('body,html').animate({scrollTop: c}, 800);
                    }
                    if (m.code_game != "") {
                        $('#code_game').val('');
                        $('#code_game').attr('placeholder', m.name);
                        var c = $("#code_game").position().top;
                        $('body,html').animate({scrollTop: c}, 800);
                    }
                    if (m.name != "") {
                        $('#name').val('');
                        $('#name').attr('placeholder', m.name);
                        var c = $("#name").position().top;
                        $('body,html').animate({scrollTop: c}, 800);
                    }

                }
                $('button:submit').attr("disabled", false);
            });
            */

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
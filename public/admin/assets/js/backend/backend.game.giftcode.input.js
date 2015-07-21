var FORM = null;
var statecreate = true;
$(document).ready(function() {
    FORM = $('form');
    CKEDITOR.replace('content');
    BACKEND.init();
});
var keyword = [];
var BACKEND = {
    AJAX_URL_COMMIT: '/backend/ajax/addgiftcode',
    AJAX_URL_GET_GAME: '/backend/ajax/getgameofpublisher',
    AJAX_URL_SCANKEYWORD: '/backend/ajax/scan_keyword_giftcode',
    commit: function() {
        $('#frm-add-game-giftcode').submit(function(e) {
            e.preventDefault();

            $('button:submit').attr("disabled", true);

            var form = new FormData($('#frm-add-game-giftcode')[0]);
            console.log(form);
            if ($('#jqxDropdownlistPub').val() != '') {
                form.append("id_publisher", arrPublisherName[$('#jqxDropdownlistPub').val()]);
            }
            if ($('#jqxDropdownlistGame').val() != '') {
                form.append("id_game", arrGameName[$('#jqxDropdownlistGame').val()]);
            }
            form.append("content", CKEDITOR.instances['content'].getData());
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
                console.log(data);
                if (data.code == 0) {
                    //$('#mask-div').show();
                    //var m = data.message;
                    //$('#id_name').val(m.id_name);
                    //BACKEND.scanKeyword(data.redirect);
                    setTimeout(function() {
                        window.location.href = data.redirect, 1000
                    });
                } else {
                    var m = data.message;
                    /*
                     if (m.phone!= "") {
                     $('#phone').val('');
                     $('#phone').attr('placeholder', m.phone);
                     var c = $("#phone").position().top;
                     $('body,html').animate({scrollTop: c}, 800);
                     }	
                     if (m.address!= "") {
                     $('#address').val('');
                     $('#address').attr('placeholder', m.address);
                     var c = $("#address").position().top;
                     $('body,html').animate({scrollTop: c}, 800);
                     }
                     */
                    if (m.csv_name != "") {
                        $('#csv_name').html(m.csv_name);
                        var c = $("#csv_name").position().top;
                        $('body,html').animate({scrollTop: c}, 800);
                    }
                    if (m.name != "") {
                        $('#name').val('');
                        $('#name').attr('placeholder', m.name);
                        var c = $("#name").position().top;
                        $('body,html').animate({scrollTop: c}, 800);
                    }
                    if (m.id_game != "") {
                        $('#id_game').html(m.id_game);
                        var c = $("#id_game").position().top;
                        $('body,html').animate({scrollTop: c}, 800);
                    }
                    if (m.id_publisher != "") {
                        $('#id_publisher').html(m.id_publisher);
                        var c = $("#id_publisher").position().top;
                        $('body,html').animate({scrollTop: c}, 800);
                    }


                }
                $('button:submit').attr("disabled", false);
            });

        });

    },
    init: function() {
        BACKEND.initDropdownlistPub(PUB_NAME);
        BACKEND.initDropdownlistGame(GAME_NAME);
        BACKEND.initChangeGame();
        BACKEND.commit();
    },
    initJqxInput: function(arr) {
        $("#txt_nph").jqxInput({source: arr, theme: THEME});
    },
    startLoading: function() {
        $('#loading').show();
    },
    topLoading: function() {
        $('#loading').hide();
        $('button:submit').attr("disabled", false);
    },
    initDropdownlistPub: function(data) {
        var source = arrPublisher;

        $("#jqxDropdownlistPub").jqxDropDownList({source: source, filterable: true, filterPlaceHolder: 'Tìm kiếm', searchMode: 'containsignorecase', /*selectedIndex: 0,*/ width: '50%', height: '25', theme: 'office', placeHolder: "Vui lòng chọn"});

        if (data != '') {
            $("#jqxDropdownlistPub").jqxDropDownList('selectItem', data);
        }

    },
    initDropdownlistGame: function(data) {
        var source = arrGame;

        $("#jqxDropdownlistGame").jqxDropDownList({source: source, filterable: true, filterPlaceHolder: 'Tìm kiếm', searchMode: 'containsignorecase', width: '50%', height: '25', theme: 'office', placeHolder: "Vui lòng chọn"});

        if (data != '') {
            data = data.replace(/`/g, "'");
            $("#jqxDropdownlistGame").jqxDropDownList('selectItem', data);
        }

    },
    getGameOfPublisher: function(id_publisher) {
        $.ajax({
            url: BACKEND.AJAX_URL_GET_GAME,
            type: 'GET',
            dataType: 'JSON',
            data: {id_publisher: id_publisher}
        }).done(function(response) {
            console.log(response);
            if (response.code != 0) {
                alert(response.message);
            } else {
                arrGame = $.parseJSON(response.data);
                BACKEND.initDropdownlistGame(GAME_NAME);
            }
        }).fail(function() {
            alert('Có lỗi ! Không kết nối đến dữ liệu được.');
        });
    },
    initChangeGame: function() {
        $('#jqxDropdownlistGame').on('select', function(event)
        {
            var args = event.args;
            if (args) {
                //var index = args.index;
                var item = args.item;
                //var label = item.label;
                var value = item.value;
                var checked = item.checked;
                //var checkedItems = $("#jqxDropdownlistGame").jqxDropDownList('getCheckedItems');
                $.ajax({
                    url: '/backend/ajax/getGameKeyword',
                    type: 'POST',
                    data: {'game': value},
                    success: function(response) {
                        var obj = JSON.parse(response);
                        if (obj.code == 1) {
                            for (var i = 0; i < keyword.length; i++) {
                                $('#seo_keyword').removeTag(keyword[i]);
                            }
                            keyword = ((obj.result.keyword != '') ? JSON.parse(obj.result.keyword) : '');
                            var key = $('#seo_keyword').val();
                            //var tags = keyword.split(',');
                            var key = key.split(',');


                            //if (checked && keyword.length>0) {
                            for (var i = 0; i < keyword.length; i++) {
                                if ($.inArray(keyword[i], key) == -1)
                                    $('#seo_keyword').addTag(keyword[i], {focus: false, callback: false});
                            }
                            /*
                             } else {
                             for (var i = 0; i < keyword.length; i++) {
                             $('#seo_keyword').removeTag(keyword[i]);
                             }
                             }
                             */
                        }
                    }
                });
            }
        });
    },
    scanKeyword: function(redirect) {
        var id_name = $('#id_name').val();
        $.ajax({
            url: BACKEND.AJAX_URL_SCANKEYWORD,
            type: 'POST',
            dataType: 'JSON',
            cache: false,
            data: {
                id_name: id_name
            }
        }).done(function(response) {
            $('#mask-div').hide();
            setTimeout(function() {
                window.location.href = redirect, 1000
            });
        }).fail(function() {

        });
    }
}


$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

 
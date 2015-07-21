var FORM = null;
var statecreate = true;
$(document).ready(function() {
    FORM = $('form');
    //CKEDITOR.replace('content');
    BACKEND.init();    
});

var BACKEND = {
    AJAX_URL_COMMIT: '/backend/ajax/addtygia',    
    commit: function() {
        $('#frm-add-game').submit(function(e) {
            e.preventDefault();

            $('button:submit').attr("disabled", true);
            var form = new FormData($('#frm-add-game')[0]);
            console.log(form);
                
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
                    $('#type').html('');
                    var m = data.message;


                    if (m.icoin != "") {
                        $('#icoin').val('');
                        $('#icoin').attr('placeholder', m.icoin);
                        var c = $("#icoin").position().top;
                        $('body,html').animate({scrollTop: c}, 800);
                    }
                    if (m.value != "") {
                        $('#value').val('');
                        $('#value').attr('placeholder', m.value);
                        var c = $("#value").position().top;
                        $('body,html').animate({scrollTop: c}, 800);
                    }                    
                    if (m.type != "") {
                        $('#type').html(m.type);
                        var c = $("#type").position().top;
                        $('body,html').animate({scrollTop: c}, 800);
                    }
                }
                $('button:submit').attr("disabled", false);
            });

        });

    },
    init: function() {
        BACKEND.initDropdownlistType(TYPE);
        BACKEND.commit();
    },   
    initDropdownlistType: function(data) {
        var source = ["card", "win"];

        $("#jqxDropdownlistType").jqxDropDownList({source: source, /*selectedIndex: 0,*/ width: '40%', height: '25', theme: 'office', placeHolder: "Vui lòng chọn"});

        if (data != '') {
            $("#jqxDropdownlistType").jqxDropDownList('selectItem', data);
        }

    },
    startLoadingg: function() {
        $('#loading-input').css({display: 'inline'});
    },
    topLoadingg: function() {
        $('#loading-input').hide();
    },
    startLoading: function() {
        $('#loading').show();
        $('#loading').css({display: 'inline'});
    },
    topLoading: function() {
        $('#loading').hide();
        $('button:submit').attr("disabled", false);
    },    
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

 